<?php
require_once('migrations/CreateProductsTable.php');
require_once('migrations/CreateProductTypesTable.php');
use database\migrations\CreateProductsTable;
use database\migrations\CreateProductTypesTable;

CreateProductsTable::migrateDown();
CreateProductTypesTable::migrateDown();

?>