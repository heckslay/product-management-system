<?php

namespace database\migrations;

use database\Connection;

require_once('database/Connection.php');

class CreateProductsTable
{
    public static function migrateUp()
    {
        try {
            $connection = Connection::connectToDatabase();
            $createTableSql = 'CREATE TABLE Products (
                            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                            sku VARCHAR(30) NOT NULL,
                            name VARCHAR(30) NOT NULL,
                            price decimal(50),
                            deleted_at TIMESTAMP)';
            $connection->exec($createTableSql);
            echo 'Created Table Products Successfully';
        } catch (\PDOException $e) {
            echo 'Failed To Create Products Table: ' . $e->getMessage();
        }
    }

    public static function migrateDown()
    {
        try {
            $connection = Connection::connectToDatabase();
            $createTableSql = 'DROP TABLE Products';
            $connection->exec($createTableSql);
        } catch (\PDOException $e) {
            echo 'Failed To Drop Products Table: ' . $e->getMessage();
        }
    }
}