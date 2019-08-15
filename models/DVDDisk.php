<?php

namespace models;


class DVDDisk extends Product
{
    private $size;

    /**
     * DVDDisk constructor.
     * @param $sku
     * @param $name
     * @param $price
     * @param $size
     */
    public function __construct($sku, $name, $price, $size)
    {
        parent::__construct($sku, $name, $price);
        $this->size = $size;
    }


}