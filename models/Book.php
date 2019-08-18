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