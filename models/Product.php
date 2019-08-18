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

    /**
     * @return array
     * Simple method which selects all not deleted products
     * from database and returns them as an associative array.
     */
    public static function getAllProducts()
    {
        $connection = Connection::connectToDatabase();
        $allProductsPrep = $connection->prepare('SELECT products.id as product_id,sku,name,price,size,
                                                           weight,dimensions, product_type_id
                                                           FROM products 
                                                           left join product_types 
                                                               on products.product_type_id = product_types.id 
                                                           WHERE deleted_at is null');
        $allProductsPrep->execute();
        $allProductsPrep->setFetchMode(PDO::FETCH_ASSOC);
        $allProductsArr = $allProductsPrep->fetchAll();
        return $allProductsArr;
    }


    /**
     * @param $colNameBoundValueMap
     * @return bool
     * Universal method which saves new product in database.
     * Works for both Product class objects and classes who inherit Product.
     */
    public function saveInDatabase($colNameBoundValueMap)
    {
        /*
         * Declare the variables, loop through the input array
         * to create the data structures required to assemble database query
         * for product insertion.
         */
        $colNamesStr = '';
        $colBoundValues = '';
        $counter = 0;
        $arrLength = count($colNameBoundValueMap);
        foreach ($colNameBoundValueMap as $key => $value) {
            $counter++;
            $colNamesStr .= $key . ($counter < $arrLength ? ',' : '');
            $colBoundValues .= ':' . $key . ($counter != $arrLength ? ',' : '');
        };

        try {
            $connection = Connection::connectToDatabase();
            /*
             * Set the generic columns in insert statement,
             * concatenate them with dynamic values we created few lines before.
             */
            $createProductPrep = $connection->prepare('
            INSERT INTO products(sku,name,price,product_type_id,' . $colNamesStr . ')  
             VALUES(:sku,:name,:price,:product_type_id,' . $colBoundValues . ');
            ');

            $createProductPrep->bindParam(':sku', self::getSku(), PDO::PARAM_STR);
            $createProductPrep->bindParam(':name', self::getName(), PDO::PARAM_STR);
            $createProductPrep->bindParam(':price', self::getPrice(), PDO::PARAM_INT);
            $createProductPrep->bindParam(':product_type_id', self::getProductType(), PDO::PARAM_INT);

            /*
             * Loop through Key => Value array of dynamic params
             * and do the bindings.
             */
            foreach ($colNameBoundValueMap as $colActualValueKey => $colActualValue) {
                $createProductPrep->bindParam(':' . $colActualValueKey, $colActualValue, PDO::PARAM_STR);
            }

            $createProductPrep->execute();

        } catch (\Exception $e) {
            return false;
        }

    }


    /**
     * @param $productId
     * @param bool $unmark
     * @return bool
     * Marks or unmarks (Depends on second param) deleted_at status for product.
     */
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

    /**
     * @return array
     * Method used to get Key => Value paris of product types for
     * frontend type switcher.
     */
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
    public function getProductType()
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