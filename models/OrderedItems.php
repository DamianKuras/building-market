<?php

namespace app\models;

use app\base\Application;
use app\base\Model;
use app\models\User;
use app\base\db\DbModel;

class OrderedItems extends DbModel
{

    public int $order_id = 0;
    public int $ordered_product_id = 0;
    public int $quantity = 0;
    public static function types(): array{
        return [
            'id'=>\PDO::PARAM_INT,
            'order_id'=>\PDO::PARAM_INT,
            'ordered_product_id'=> \PDO::PARAM_INT,
            'quantity'=>\PDO::PARAM_INT,
        ];
    }
    public static function tableName(): string
    {
        return 'ordered_items';
    }
    public static function primaryKey(): string
    {
        return 'id';
    }
    public function attributes(): array
    {
        return ['order_id', 'ordered_product_id', 'quantity'];
    }
    public function rules(): array
    {
        return [
            'order_id' => [self::RULE_REQUIRED],
            'ordered_product_id' => [self::RULE_REQUIRED],
            'quantity' => [self::RULE_REQUIRED],
        ];
    }
}
