<?php

namespace app\models;

use app\base\Application;
use app\base\exceptions\ForbiddenException;
use app\base\Model;
use app\models\Cart;

class CartForm extends Model
{
    public int $quantity = 0;
    public int $product_id = 0;
    public int $user_id = 0;
    public static function types(): array{
        return [
            'user_id'=>\PDO::PARAM_INT,
            'product_id'=> \PDO::PARAM_INT,
            'quantity'=>\PDO::PARAM_INT,
        ];
    }
    public function rules(): array
    {
        return [
            'quantity' => [self::RULE_REQUIRED],
        ];
    }
    public function labels(): array
    {
        return [
            'quantity' => 'Quantity',
        ];
    }
}
