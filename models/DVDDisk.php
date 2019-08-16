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
     * @param $productType
     * @param $size
     */
    public function __construct($sku, $name, $price, $productType, $size)
    {
        parent::__construct($sku, $name, $price, $productType);
        $this->size = $size;
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