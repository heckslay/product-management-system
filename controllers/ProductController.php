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

    public static function actionDeleteProducts($productIdArr)
    {
        $lastProductId = null;
        $deletionSuccess = true;
        foreach ($productIdArr as $productId) {
            if (!Product::changeDeletedStatus($productId)) {
                $deletionSuccess = false;
                $lastProductId = $productId;
                break;
            }
        }

        if (!$deletionSuccess) {
            foreach ($productIdArr as $productId) {
                if ($productId != $lastProductId) {
                    Product::changeDeletedStatus($productId, true);
                } else {
                    break;
                }
            }
        }
        return $deletionSuccess;
    }

    public static function actionAddProduct($productInfo)
    {
        if ($productInfo['type'] == Product::TYPE_BOOK) {
            $product = new Book($productInfo['sku'], $productInfo['name'], $productInfo['price'], $productInfo['type'],
                $productInfo['weight']);
        } else if ($productInfo['type'] == Product::TYPE_DVD) {
            $product = new DVDDisk($productInfo['sku'], $productInfo['name'], $productInfo['price'], $productInfo['type'],
                $productInfo['size']);
        } else if ($productInfo['type'] == Product::TYPE_FURNITURE) {
            $product = new Furniture($productInfo['sku'], $productInfo['name'], $productInfo['price'], $productInfo['type'],
                Furniture::formatDimensionsAsString($productInfo['height'], $productInfo['weight'], $productInfo['length']));
        } else {
            return false;
        }
        if ($product->saveInDatabase()) {
            return true;
        }

        return false;
    }

}