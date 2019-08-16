<?php
$pageName = 'product-list';
if(isset($_GET['pageName'])) {
    $pageName = $_GET['pageName'];
}
require_once '../views/' . $pageName . '.php';