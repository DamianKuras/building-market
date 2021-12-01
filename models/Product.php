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
    public int $price = 0;
    public string $category = '';
    public string $imageLink = '';
    public string $brand = '';
    public string $description = '';
    public int $quantityInStock = 0;
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
            'imageLink' => [self::RULE_REQUIRED],
            'brand' => [self::RULE_REQUIRED],
            'quantityInStock' => [self::RULE_REQUIRED],
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
        return ['name', 'price', 'category', 'imageLink', 'brand', 'quantityInStock', 'description'];
    }

    public function labels(): array
    {
        return [
            'name' => 'Name',
            'price' => 'Price',
            'category' => 'Category',
            'brand' => 'Brand',
            'imageLink' => 'Image',
            'quantityInStock' => 'Quantity in stock',
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
    public function getStockQuantity(int $id)
    {
        $product = new Product();
        $product->getById($id);
        return $product->quantity;
    }
    public function verifyQuantity(int $quantity)
    {
        return ($this->quantityInStock >= $quantity);
    }
    public function removeFromStock(int $amount)
    {
        $remaining = $this->quantityInStock - $amount;
        parent::update(['id' => $this->id], ['quantityInStock' => $remaining]);
    }
    public function setStockAmount(int $id, int $amount)
    {
        $product = new Product();
        $product->getById($id);
        parent::update(['id' => $product->id], ['quantityInStock' => $amount]);
    }
    public function ProductUpdate()
    {
        parent::update(['id' => $this->id],[
            'name' => $this->name, 'price' => $this->price, 'category' => $this->category,
            'imageLink' => $this->imageLink, 'brand' => $this->brand, 'description' => $this->description, 'quantityInStock' => $this->quantityInStock
        ]);
        
        return true;
    }
    public function searchAllProductsWithText(string $searchText){
        $products=parent::findAllWhere(['name'=>$searchText,'category'=>$searchText,'description'=>$searchText]);
        return $products;
    }
}
