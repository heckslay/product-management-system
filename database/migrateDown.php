<?php
require_once('migrations/CreateProductsTable.php');
use database\migrations\CreateProductsTable;

CreateProductsTable::migrateDown();

?>