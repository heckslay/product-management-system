<?php

namespace models;


use database\Connection;
use PDO;

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

    public function saveInDatabase()
    {
        try {
            var_dump(self::getType());exit;
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