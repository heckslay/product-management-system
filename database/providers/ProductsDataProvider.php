<?php

namespace database\providers;
require_once('../database/Connection.php');
require_once('../models/Product.php');
require_once('../models/Furniture.php');
require_once('../models/Book.php');
require_once('../models/DVDDisk.php');

use database\Connection;
use models\Product;
use models\Furniture;
use models\Book;
use models\DVDDisk;
use PDO;


class ProductsDataProvider
{
    public static function getAllProducts()
    {
        $connection = Connection::connectToDatabase();
        $allProductsPrep = $connection->prepare('SELECT * FROM products 
                                                           left join product_types 
                                                               on products.product_type_id = product_types.id 
                                                           WHERE deleted_at is null');
        $allProductsPrep->execute();
        $allProductsPrep->setFetchMode(PDO::FETCH_ASSOC);
        $allProductsArr = $allProductsPrep->fetchAll();
        return $allProductsArr;

    }
}