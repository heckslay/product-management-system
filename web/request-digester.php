<?php

namespace web;

require_once '../controllers/ProductController.php';

use controllers\ProductController;

$result = [
    'success' => false
];

$postData = $_POST;
if ($postData['action'] == 'delete') {
    if (ProductController::actionDeleteProducts($postData['productIds'])) {
        $result['success'] = true;
    }
    return json_encode($result);
} else if ($postData['action'] == 'add') {
    if (ProductController::actionAddProduct($postData['productInfo'])) {
        $result['success'] = true;
    }
}
