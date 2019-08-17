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
            $createProductPrep = $connection->prepare('');
            $createProductPrep->bindParam(':productId', $productId, PDO::PARAM_INT);
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

    public static function formatDimensionsAsString($height, $weight, $length)
    {
        return $height . 'x' . $weight . 'x' . $length;
    }


}