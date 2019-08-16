<?php

namespace models;


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


}