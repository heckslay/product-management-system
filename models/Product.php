<?php

namespace models;

abstract class Product
{

    public $tableName = 'Products';
    private $sku;
    private $name;
    private $price;
    private $productType;
    const TYPE_BOOK = 1;
    const TYPE_DVD = 2;
    const TYPE_FURNITURE = 3;

    /**
     * Product constructor.
     * @param $sku
     * @param $name
     * @param $price
     * @param $productType
     */
    public function __construct($sku, $name, $price, $productType)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->productType = $productType;
    }


    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param mixed $sku
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->productType;
    }

    /**
     * @param mixed $productType
     */
    public function setType($productType)
    {
        $this->productType = $productType;
    }



}