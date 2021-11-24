<?php

namespace app\base\db;

use app\base\Model;
use app\base\Application;

abstract class DbModel extends Model
{
    abstract public static function tableName(): string;
    abstract public function attributes(): array;

    abstract public static function primaryKey(): string;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn ($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES (" . implode(',', $params) . ")");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }
    public function saveWithId()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn ($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES (" . implode(',', $params) . ")");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return Application::$app->db->pdo->lastInsertId();
    }
    public static function update($where, $what)
    {
        $tableName = static::tableName();
        $attributesWhere = array_keys($where);
        $attributesWhat = array_keys($what);
        $whereSql = implode(" AND ", array_map(fn ($attr) => "$attr = :$attr", $attributesWhere));
        $whatSql = implode(", ", array_map(fn ($attr) => "$attr = :$attr", $attributesWhat));
        $statement = self::prepare("UPDATE $tableName SET $whatSql WHERE $whereSql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        foreach ($what as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();
        return true;
    }
    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }

    public static function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn ($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }
    public static function getAll()
    {
        $tableName = static::tableName();
        $statement = self::prepare("SELECT * FROM $tableName");
        $statement->execute();
        return $statement->fetchAll();
    }
    public static function getAllWhere($where): array
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn ($attr) => "$attr = :$attr", $attributes));

        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");

        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchAll();
    }
    public static function get($amount): array
    {
        $tableName = static::tableName();
        $statement = self::prepare("SELECT * FROM $tableName LIMIT $amount");
        $statement->execute();
        return $statement->fetchAll();
    }
    public static function remove($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn ($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("DELETE FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return true;
    }
}
