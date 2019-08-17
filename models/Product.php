<?php

namespace models;

use database\Connection;
use PDO;

abstract class Product
{

    public $tableName = 'Products';
    private $sku;
    private $name;
    private $price;
    private $productType;
    const TYPE_BOOK = 1;
    const TYPE_DVD = 2;
    const TYPE_FURNITURE = 3;

    /**
     * Product constructor.
     * @param $sku
     * @param $name
     * @param $price
     * @param $productType
     */
    public function __construct($sku, $name, $price, $productType)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->productType = $productType;
    }

    public static function getAllProducts()
    {
        $connection = Connection::connectToDatabase();
        $allProductsPrep = $connection->prepare('SELECT * FROM products 
                                                           left join product_types 
                                                               on products.product_type_id = product_types.id 
                                                           WHERE deleted_at is null');
        $allProductsPrep->execute();
        $allProductsPrep->setFetchMode(PDO::FETCH_ASSOC);
        $allProductsArr = $allProductsPrep->fetchAll();
        return $allProductsArr;
    }

    public static function changeDeletedStatus($productId, $unmark = false)
    {
        $deletedCondition = $unmark ? 'NULL' : 'NOW()';
        try {
            $connection = Connection::connectToDatabase();
            $deleteProductsPrep = $connection->prepare('UPDATE products SET deleted_at =' . $deletedCondition .
                ' WHERE id = :productId');
            $deleteProductsPrep->bindParam(':productId', $productId, PDO::PARAM_INT);
            $deleteProductsPrep->execute();
            return true;
        } catch (\Exception $e) {
            return false;

        }
    }

    public static function getTypesAssocArr()
    {
        return [
            'Book' => self::TYPE_BOOK,
            'DVD Disc' => self::TYPE_DVD,
            'Furniture' => self::TYPE_FURNITURE,
        ];
    }

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param mixed $sku
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->productType;
    }

    /**
     * @param mixed $productType
     */
    public function setType($productType)
    {
        $this->productType = $productType;
    }


}