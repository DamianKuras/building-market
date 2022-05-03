<?php

namespace app\models;

use app\base\db\DbModel;

class User extends DbModel
{
    public int $id = 0;
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';
    public bool $isadmin = false;
    public static function types(): array{
        return [
            'id'=>\PDO::PARAM_INT,
            'username'=>\PDO::PARAM_STR,
            'email'=> \PDO::PARAM_STR,
            'password'=>\PDO::PARAM_STR,
            'isadmin'=>\PDO::PARAM_BOOL,
        ];
    }
    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }
    public function rules(): array
    {
        return [
            'username' => [self::RULE_REQUIRED, [self::RULE_UNIQUE, 'class' => self::class]],
            //'email' => [ self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],// disabled to make registering for testing website easier 
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 5], [self::RULE_MAX, 'max' => 20]],
            'passwordConfirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }
    public static function tableName(): string
    {
        return 'users';
    }
    public static function primaryKey(): string
    {
        return 'id';
    }
    public function attributes(): array
    {
        return ['username', 'email', 'password', 'isadmin'];
    }

    public function labels(): array
    {
        return [
            'username' => 'Username',
            'email' => 'E-mail',
            'password' => 'Password',
            'passwordConfirm' => 'Password confirm',
        ];
    }
    public function getDisplayName(): string
    {
        return $this->username;
    }

    public function isAdmin()
    {
        return $this->isadmin;
    }

}
