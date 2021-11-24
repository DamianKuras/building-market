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
    public string $time;
    public int $total = 0;
    public function rules(): array
    {
        return [
            'id' =>  [self::RULE_REQUIRED],
            'user_id' => [self::RULE_REQUIRED],
            'status' => [self::RULE_REQUIRED],
            'time' => [self::RULE_REQUIRED],
            'total' => [self::RULE_REQUIRED],
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
        return ['id', 'user_id', 'status', 'time', 'total'];
    }
    public function markAsSended()
    {
        parent::update(['id' => $this->id], ['status' => self::STATUS_SENDED]);
    }
    public function getStatusLabel(int $code)
    {
        if ($code == 0) {
            return 'Oczekujące';
        }
        if ($code == 2) {
            return 'Wysłane';
        }
    }
}
