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
    public string $shippingDay="";
    public int $shippingCost=0;
    public int $totalProductsCost=0;
    public int $totalIncludingTaxes = 0;

    public function rules(): array
    {
        return [
            'id' =>  [self::RULE_REQUIRED],
            'user_id' => [self::RULE_REQUIRED],
            'status' => [self::RULE_REQUIRED],
            'time' => [self::RULE_REQUIRED],
            'shippingDay' =>[self::RULE_REQUIRED],
            'shippingCost' => [self::RULE_REQUIRED],
            'totalProductsCost' => [self::RULE_REQUIRED],
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
        return ['id', 'user_id', 'status', 'time','shippingDay' ,'shippingCost','totalProductsCost'];
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
