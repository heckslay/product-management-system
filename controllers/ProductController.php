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
            $weight = $productInfo['dynamicValues'][0];
            $product = new Book($productInfo['sku'], $productInfo['name'], $productInfo['price'], $productInfo['type'],
                $weight);
        } else if ($productInfo['type'] == Product::TYPE_DVD) {
            $size = $productInfo['dynamicValues'][0];
            $product = new DVDDisk($productInfo['sku'], $productInfo['name'], $productInfo['price'], $productInfo['type'],
                $size);
        } else if ($productInfo['type'] == Product::TYPE_FURNITURE) {
           $dimensions = Furniture::formatDimensionsAsString($productInfo['dynamicValues']);
            $product = new Furniture($productInfo['sku'], $productInfo['name'], $productInfo['price'], $productInfo['type'],
                $dimensions);
        } else {
            return false;
        }
        if ($product->saveInDatabase()) {
            return true;
        }

        return false;
    }

}