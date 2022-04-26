<?php

namespace app\base\db;

use app\base\Model;
use app\base\Application;
use app\base\exceptions\DBException;

abstract class DbModel extends Model
{
    abstract public static function tableName(): string;
    abstract public function attributes(): array;
    abstract public static function types(): array;
    abstract public static function primaryKey(): string;

    public function save()
    {
        try {
            $tableName = $this->tableName();
            $attributes = $this->attributes();
            $types = $this->types();
            $params = array_map(fn ($attr) => ":$attr", $attributes);
            $statement = self::prepare("INSERT INTO $tableName (" . implode(",", $attributes) . ") VALUES (" . implode(",", $params) . ")");
            foreach ($attributes as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute}, $types[$attribute]);
            }
            $statement->execute();
            return true;
        } catch (\PDOException $e) {
            throw new DBException();
        }
    }
    public function saveWithId() :int
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $types = $this->types();
        $params = array_map(fn ($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (" . implode(",", $attributes) . ") VALUES (" . implode(",", $params) . ")");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute}, $types[$attribute]);
        }
        $statement->execute();
        return Application::$app->db->pdo->lastInsertId();
    }
    public static function update($where, $what)
    {
        $tableName = static::tableName();
        $attributesWhere = array_keys($where);
        $attributesWhat = array_keys($what);
        $types = static::types();
        $whereSql = implode(" AND ", array_map(fn ($attr) => "$attr = :$attr", $attributesWhere));
        $whatSql = implode(", ", array_map(fn ($attr) => "$attr = :$attr", $attributesWhat));
        $statement = self::prepare("UPDATE $tableName SET $whatSql WHERE $whereSql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item, $types[$key]);
        }
        foreach ($what as $key => $item) {
            $statement->bindValue(":$key", $item, $types[$key]);
        }

        $statement->execute();
        return true;
    }
    public static function prepare($sql): \PDOStatement
    {
        return Application::$app->db->pdo->prepare($sql);
    }

    public static function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $types = static::types();
        $sql = implode(" AND ", array_map(fn ($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item, $types[$key]);
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
        $types = static::types();
        $sql = implode(" AND ", array_map(fn ($attr) => "$attr = :$attr", $attributes));

        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");

        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item, $types[$key]);
        }
        $statement->execute();
        return $statement->fetchAll();
    }
    public static function findAllWhere($where): array
    {
        error_log( print_r( $where, true ) );
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $types = static::types();
        $sql = implode(" OR ", array_map(fn ($attr) => " $attr like CONCAT('%',CAST(:$attr as VARCHAR),'%')", $attributes));
        file_put_contents("php://stderr", "$tableName \n");
        file_put_contents("php://stderr", "$sql \n");
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            file_put_contents("php://stderr", ":$key \n");
            file_put_contents("php://stderr", "$item \n");
            file_put_contents("php://stderr", "$types[$key] \n");
            $statement->bindValue(":$key", $item, $types[$key]);
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
        $types = static::types();
        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn ($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("DELETE FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item, $types[$key]);
        }
        $statement->execute();
        return true;
    }
}
