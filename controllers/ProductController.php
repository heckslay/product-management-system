<?php

namespace controllers;
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


class ProductController
{
    public static function actionGetAllProducts()
    {
        return Product::getAllProducts();
    }

    public static function deleteProducts($productIdArr)
    {
        foreach ($productIdArr as $productId) {
            Product::setDeleted($productId);
        }
    }

}