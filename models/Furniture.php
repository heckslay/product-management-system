<?php

namespace models;


class Furniture extends Product
{
    private $dimensions;


    /**
     * Furniture constructor.
     * @param $sku
     * @param $name
     * @param $price
     * @param $dimensions
     */
    public function __construct($sku, $name, $price, $dimensions)
    {
        parent::__construct($sku, $name, $price);
        $this->dimensions = $dimensions;
    }


}