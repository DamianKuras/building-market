<?php

namespace app\models;

use app\base\Application;
use app\base\Model;
use app\models\User;

class LoginForm extends Model
{

    public string $username = '';
    public string $password = '';
    public static function types(): array{
        return [
            'username'=>\PDO::PARAM_STR,
            'password'=>\PDO::PARAM_STR,
        ];
    }
    public function rules(): array
    {
        return [
            'username' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED]
        ];
    }
    public function labels(): array
    {
        return [
            'username' => 'Username',
            'password' => 'Password'
        ];
    }
    public function login()
    {
        $user = User::findOne(['username' => $this->username]);
        if (!$user || !password_verify($this->password, $user->password)) {
            $this->addError('username', 'Username or password is incorrect.');
            return false;
        }
        return Application::$app->login($user);
    }

}
