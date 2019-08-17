<?php

namespace controllers;

require_once('../database/Connection.php');
require_once('../models/Product.php');
require_once('../models/Furniture.php');
require_once('../models/Book.php');
require_once('../models/DVDDisk.php');

use models\Product;
use models\Furniture;
use models\Book;
use models\DVDDisk;


class ProductController
{
    /**
     * @return array
     * Calls a Product class static method to get all products as array
     */
    public static function actionGetAllProducts()
    {
        return Product::getAllProducts();
    }

    /**
     * @param $productIdArr
     * @return bool
     * Calls a method which sets a deleted at attribute for each ID in parameter array. If something fails,
     * it will rever the changes.
     */
    public static function actionDeleteProducts($productIdArr)
    {
        /*
         * Loop through the product ID's user needs to delete
         * call a purifier method on each one
         */
        foreach ($productIdArr as $productIdKey => $productId) {
            $productIdArr[$productIdKey] = self::purifyUserInput($productId);
        }

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

    /**
     * @param $productInfo
     * @return bool
     * A method which gets productInfo and decides which model's instance to use according to passed type.
     * After that, it saves new entries to database. If succeed, returns true.
     */
    public static function actionAddProduct($productInfo)
    {
        /*
         * Loop through the items of the productInfo array and
         * dynamic values subarray and purify the input data
         */
        foreach ($productInfo as $productDataKey => $productData) {
            if (!is_array($productData)) {
                $productInfo[$productDataKey] = self::purifyUserInput($productData);
            } else {
                foreach ($productData as $productDatumKey => $productDatum) {
                    $productInfo['dynamicValues'][$productDatumKey] = self::purifyUserInput($productDatum);
                }
            }
        }


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

    public static function purifyUserInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}