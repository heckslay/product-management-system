<?php
/*
 * This file handles the routing between pages. It receives a view name parameter from _GET and
 * selects the view accordingly.
 */

$pageName = 'product-list';
if(isset($_GET['pageName'])) {
    $pageName = $_GET['pageName'];
}
require_once '../views/' . $pageName . '.php';