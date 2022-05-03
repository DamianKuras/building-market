<?php

namespace app\models;

use app\base\Application;
use app\base\db\DbModel;

class Orders extends DbModel
{
    public const STATUS_PENDING = 0;
    public const STATUS_CONFIRMED = 1;
    public const STATUS_SENDED = 2;
    public const STATUS_RECIVED = 3;
    public const STATUS_CANCELED = 4;
    public const STATUS_RETURNED = 5;

    public int $id = 0;
    public int $user_id = 0;
    public int $status = 0;
    public string $time="";
    public string $shipping_day="";
    public int $shipping_cost=0;
    public int $total_products_cost=0;

    public static function types(): array{
        return [
            'id'=>\PDO::PARAM_INT,
            'user_id' => \PDO::PARAM_INT,
            'status' => \PDO::PARAM_INT,
            'time' => \PDO::PARAM_STR,
            'shipping_day' =>\PDO::PARAM_STR,
            'shipping_cost' => \PDO::PARAM_INT,
            'total_products_cost' => \PDO::PARAM_INT,
        ];
    }
    public function rules(): array
    {
        return [
            'user_id' => [self::RULE_REQUIRED],
            'status' => [self::RULE_REQUIRED],
            'time' => [self::RULE_REQUIRED],
            'shipping_day' =>[self::RULE_REQUIRED],
            'shipping_cost' => [self::RULE_REQUIRED],
            'total_products_cost' => [self::RULE_REQUIRED],
        ];
    }
    public function labels(): array
    {
        return [
            'status' => 'Status',
            'time' => 'Date and time'
        ];
    }
    public static function tableName(): string
    {
        return 'orders';
    }
    public static function primaryKey(): string
    {
        return 'id';
    }
    public function attributes(): array
    {
        return ['user_id', 'status', 'time','shipping_day' ,'shipping_cost','total_products_cost'];
    }
    public function changeStatusToSended()
    {
        parent::update(['id' => $this->id], ['status' => self::STATUS_SENDED]);
    }
    public function changeStatusToConfirmed(){
        parent::update(['id'=>$this->id],['status'=>self::STATUS_CONFIRMED]);
    }
    public static function getStatusLabel(int $code)
    {
        if ($code == self::STATUS_PENDING) {
            return 'In progress';
        }
        if($code == self::STATUS_CONFIRMED){
            return 'Confirmed';
        }
        if ($code == self::STATUS_SENDED) {
            return 'Send';
        }
       
    }
}
