<?php

namespace app\models;

use app\base\Model;

class ContactForm extends Model
{
    public string $email = '';
    public string $body = '';
    public static function types(): array{
        return [
            'email'=>\PDO::PARAM_STR,
            'body'=>\PDO::PARAM_STR,
        ];
    }
    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED],
            'body' => [self::RULE_REQUIRED],
        ];
    }
    public function labels(): array
    {
        return [
            'email' => 'E-mail',
            'body' => 'Message',
        ];
    }
    public function send()
    {
        return true;
    }
}
