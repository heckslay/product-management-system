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
     * @param $productType
     * @param $dimensions
     */
    public function __construct($sku, $name, $price, $productType, $dimensions)
    {
        parent::__construct($sku, $name, $price,$productType);
        $this->dimensions = $dimensions;
    }


}