<?php

namespace models;


use database\Connection;
use PDO;

class DVDDisk extends Product
{
    private $size;


    /**
     * DVDDisk constructor.
     * @param $sku
     * @param $name
     * @param $price
     * @param $productType
     * @param $size
     */
    public function __construct($sku, $name, $price, $productType, $size)
    {
        parent::__construct($sku, $name, $price, $productType);
        $this->size = $size;
    }

    public function saveInDatabase()
    {
        try {
            $connection = Connection::connectToDatabase();
            $createProductPrep = $connection->prepare('
            INSERT INTO products(sku,name,price,size,product_type_id,created_at)  
             VALUES(:sku,:name,:price,:size,:type,NOW());
            ');
            $createProductPrep->bindParam(':sku', self::getSku(), PDO::PARAM_STR);
            $createProductPrep->bindParam(':name', self::getName(), PDO::PARAM_STR);
            $createProductPrep->bindParam(':price', self::getPrice(), PDO::PARAM_INT);
            $createProductPrep->bindParam(':size', self::getSize(), PDO::PARAM_STR);
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
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }


}