<?php
namespace models;

use app\base\Application;
use app\base\db\DbModel;
class SavedOrderedProduct extends DbModel{

    public int $user_id;
    public int $product_id;
    public int $quantity;
    public static function types(): array{
        return [
            'id'=>\PDO::PARAM_INT,
            'user_id' =>  \PDO::PARAM_INT,
            'product_id' => \PDO::PARAM_INT,
            'quantity' => \PDO::PARAM_INT,
        ];
    }
    public function rules(): array
    {
        return [
            'user_id' =>  [self::RULE_REQUIRED],
            'product_id' => [self::RULE_REQUIRED],
            'quantity' => [self::RULE_REQUIRED]
        ];
    }
    public static function tableName(): string
    {
        return 'cart_items';
    }
    public static function primaryKey(): string
    {
        return 'id';
    }
    public function attributes(): array
    {
        return ['user_id','product_id','quantity'];
    }
    public function getCardItems(int $user_id):array{
        $products= Cart::getAllWhere(['user_id' => $user_id]);
        return $products;
    }
    public function removeFromCart(int $user_id, int $product_id){
        Cart::remove(['user_id'=> $user_id,'product_id'=>$product_id]);
    }


}