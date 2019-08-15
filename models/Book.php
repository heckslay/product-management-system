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
     * @param $weight
     */
    public function __construct($sku, $name, $price, $weight)
    {
        parent::__construct($sku, $name, $price);
        $this->weight = $weight;
    }


}