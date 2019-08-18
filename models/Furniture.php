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