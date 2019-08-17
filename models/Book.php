<?php

namespace models;


use database\Connection;
use PDO;

class Book extends Product
{
    private $weight;


    /**
     * Book constructor.
     * @param $sku
     * @param $name
     * @param $price
     * @param $productType
     * @param $weight
     */
    public function __construct($sku, $name, $price, $productType, $weight)
    {
        parent::__construct($sku, $name, $price, $productType);
        $this->weight = $weight;
    }

    /**
     * @return bool
     * Creates a record of type Book in Products Table.
     */
    public function saveInDatabase()
    {
        try {
            $connection = Connection::connectToDatabase();
            $createProductPrep = $connection->prepare('
            INSERT INTO products(sku,name,price,weight,product_type_id,created_at)  
             VALUES(:sku,:name,:price,:weight,:type,NOW());
            ');
            $createProductPrep->bindParam(':sku', self::getSku(), PDO::PARAM_STR);
            $createProductPrep->bindParam(':name', self::getName(), PDO::PARAM_STR);
            $createProductPrep->bindParam(':price', self::getPrice(), PDO::PARAM_INT);
            $createProductPrep->bindParam(':weight', self::getWeight(), PDO::PARAM_STR);
            $createProductPrep->bindParam(':type', self::getType(), PDO::PARAM_INT);
            $createProductPrep->execute();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }


}