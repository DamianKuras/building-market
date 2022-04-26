<?php

namespace app\models;

use app\base\Application;
use app\base\db\DbModel;

class Cart extends DbModel
{

    public int $user_id=0;
    public int $product_id=0;
    public int $quantity=0;
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
        return ['user_id', 'product_id', 'quantity'];
    }
    public function getCardItems(int $user_id): array
    {
        $products = Cart::getAllWhere(['user_id' => $user_id]);
        return $products;
    }
    public function removeFromCart(int $user_id, int $product_id)
    {
        Cart::remove(['user_id' => $user_id, 'product_id' => $product_id]);
    }
    public function itemAlreadyInCart(int $user_id, int $product_id)
    {
        $inCart = Cart::findOne(['user_id' => $user_id, 'product_id' => $product_id]);
        if ($inCart) {
            return true;
        } else {
            return false;
        }
    }
    public function addQuantityToExisting(int $user_id, int $product_id, int $added_quantity)
    {

        $item = Cart::findOne(['user_id' => $user_id, 'product_id' => $product_id]);
        $newQuantityValue = $item->quantity + $added_quantity;
        Cart::update(['user_id' => $user_id, 'product_id' => $product_id], ['quantity' => $newQuantityValue]);
    }
    public function setQuantityOfExisting(int $user_id, int $product_id, int $quantity){
        Cart::update(['user_id' => $user_id, 'product_id' => $product_id], ['quantity' => $quantity]);
    }
    public function setQuantityOfProduct(int $user_id,int $product_id, int $quantity){
        Cart::update(['user_id' => $user_id, 'product_id' => $product_id], ['quantity' => $quantity]);
    }
}
