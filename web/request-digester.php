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
    }
