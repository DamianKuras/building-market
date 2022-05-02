<?php

namespace app\models;

use app\base\db\DbModel;
use app\base\exceptions\NotFoundException;
use app\base\exceptions\ProductNotFoundException;
use app\base\ProductModel;
use app\base\Model;

class Product extends DbModel
{

    const OUT_OF_STOCK = 0;
    const IN_STOCK = 1;
    const RUNNING_LOW = 2;
    public int $id = 0;
    public string $name = '';
    public float $price = 0;
    public string $category = '';
    public string $image_link = '';
    public string $brand = '';
    public string $description = '';
    public int $quantity_in_stock = 0;
    public static function types(): array{
        return [
            'id'=>\PDO::PARAM_INT,
            'name' => \PDO::PARAM_STR,
            'price' => \PDO::PARAM_STR,
            'category' => \PDO::PARAM_STR,
            'image_link' => \PDO::PARAM_STR,
            'brand' => \PDO::PARAM_STR,
            'quantity_in_stock' => \PDO::PARAM_INT,
            'description' => \PDO::PARAM_STR,
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
            'name' => [self::RULE_REQUIRED],
            'price' => [self::RULE_REQUIRED],
            'category' => [self::RULE_REQUIRED],
            'image_link' => [self::RULE_REQUIRED],
            'brand' => [self::RULE_REQUIRED],
            'quantity_in_stock' => [self::RULE_REQUIRED],
            'description' => [self::RULE_REQUIRED]
        ];
    }
    public static function tableName(): string
    {
        return 'products';
    }
    public static function primaryKey(): string
    {
        return 'id';
    }
    public function attributes(): array
    {
        return ['name', 'price', 'category', 'image_link', 'brand', 'quantity_in_stock', 'description'];
    }

    public function labels(): array
    {
        return [
            'name' => 'Name',
            'price' => 'Price',
            'category' => 'Category',
            'brand' => 'Brand',
            'image_link' => 'Image',
            'quantity_in_stock' => 'Quantity in stock',
            'description' => 'Description'
        ];
    }

    public function getById(int $id)
    {

        $product = Product::findOne(['id' => $id]);
        if (!$product) {
            throw new ProductNotFoundException();
        }
        return $product;
    }
    public function getAmount(int $amount = 10): array
    {
        $products[] = Product::get($amount);
        if (empty($products)) {
            throw new ProductNotFoundException();
        }
        return $products;
    }
    public function getPrice(int $id){
        $product = new Product();
        $product->getById($id);
        return $product->price;
    }
    public function getStockQuantity(int $id)
    {
        $product = new Product();
        $product->getById($id);
        return $product->quantity;
    }
    public function verifyQuantity(int $quantity)
    {
        return ($this->quantity_in_stock >= $quantity);
    }
    public function removeFromStock(int $amount)
    {
        $remaining = $this->quantity_in_stock - $amount;
        parent::update(['id' => $this->id], ['quantity_in_stock' => $remaining]);
    }
    public function setStockAmount(int $id, int $amount)
    {
        $product = new Product();
        $product->getById($id);
        parent::update(['id' => $product->id], ['quantity_in_stock' => $amount]);
    }
    public function ProductUpdate()
    {
        parent::update(['id' => $this->id],[
            'name' => $this->name, 'price' => $this->price, 'category' => $this->category,
            'image_link' => $this->image_link, 'brand' => $this->brand, 'description' => $this->description, 'quantity_in_stock' => $this->quantity_in_stock
        ]);
        
        return true;
    }
    public function searchAllProductsWithText(string $searchText): array{
        $where=['name'=>$searchText, 'category'=>$searchText, 'description'=>$searchText];
        $products = parent::findAllWhere($where);
        return $products;
    }
}
