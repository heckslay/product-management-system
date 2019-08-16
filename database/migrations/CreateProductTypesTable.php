<?php


namespace database\migrations;
require_once('database/Connection.php');


use database\Connection;

class CreateProductTypesTable
{
    public static function migrateUp()
    {
        try {
            $connection = Connection::connectToDatabase();
            $createTableSql = 'CREATE TABLE product_types (
                            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                            type VARCHAR(70) NOT NULL)';
            $connection->exec($createTableSql);
            echo 'Created Table Product Types Successfully'. PHP_EOL;
        } catch (\PDOException $e) {
            echo 'Failed To Create Product Types Table: ' . PHP_EOL . $e->getMessage();
        }
    }

    public static function migrateDown()
    {
        try {
            $connection = Connection::connectToDatabase();
            $createTableSql = 'DROP TABLE product_types';
            $connection->exec($createTableSql);
            echo 'Dropped Table Product Types Successfully' . PHP_EOL;
        } catch (\PDOException $e) {
            echo 'Failed To Drop Product Types Table: ' . PHP_EOL . $e->getMessage();
        }
    }
}