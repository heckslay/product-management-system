<?php

namespace models;


use database\Connection;
use PDO;

class Furniture extends Product
{
    private $dimensions;


    /**
     * Furniture constructor.
     * @param $sku
     * @param $name
     * @param $price
     * @param $productType
     * @param $dimensions
     */
    public function __construct($sku, $name, $price, $productType, $dimensions)
    {
        parent::__construct($sku, $name, $price, $productType);
        $this->dimensions = $dimensions;
    }

    public function saveInDatabase()
    {
        try {
            $connection = Connection::connectToDatabase();
            $createProductPrep = $connection->prepare('
            INSERT INTO products(sku,name,price,dimensions,product_type_id,created_at)  
             VALUES(:sku,:name,:price,:dimensions,:type,NOW());
            ');
            $createProductPrep->bindParam(':sku', self::getSku(), PDO::PARAM_STR);
            $createProductPrep->bindParam(':name', self::getName(), PDO::PARAM_STR);
            $createProductPrep->bindParam(':price', self::getPrice(), PDO::PARAM_INT);
            $createProductPrep->bindParam(':dimensions', self::getDimensions(), PDO::PARAM_STR);
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
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * @param mixed $dimensions
     */
    public function setDimensions($dimensions)
    {
        $this->dimensions = $dimensions;
    }

    public static function formatDimensionsAsString($paramsArr)
    {
        return $paramsArr[0] . 'x' . $paramsArr[1] . 'x' . $paramsArr[2];
    }


}