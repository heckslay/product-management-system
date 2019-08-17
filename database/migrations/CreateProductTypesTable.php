<?php


namespace database\migrations;
require_once('database/Connection.php');


use database\Connection;

class CreateProductTypesTable
{
    /**
     * A migration running method. After run, it will create a product types table
     * and will insert initial values.
     */
    public static function migrateUp()
    {
        try {
            $connection = Connection::connectToDatabase();
            $createTableSql = 'CREATE TABLE product_types (
                            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                            type VARCHAR(70) NOT NULL);
                            INSERT INTO product_types VALUES (1, \'Book\');
                            INSERT INTO product_types VALUES (2, \'DVD Disk\');
                            INSERT INTO product_types VALUES (3, \'Furniture\');';
            $connection->exec($createTableSql);

            echo 'Created Table Product Types and Inserted Initial Values Successfully' . PHP_EOL;
        } catch (\PDOException $e) {
            echo 'Failed To Create Product Types Table: ' . PHP_EOL . $e->getMessage();
        }
    }

    /**
     * Rollbacks the product types table creating migration.
     */
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