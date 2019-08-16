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
            $createTableSql = 'CREATE TABLE products (
                            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                            sku VARCHAR(70) NOT NULL,
                            name VARCHAR(70) NOT NULL,
                            price decimal(50),
                            size VARCHAR(40),
                            weight VARCHAR(40),
                            dimensions VARCHAR(40),
                            product_type_id INT(6) UNSIGNED NOT NULL,
                            deleted_at TIMESTAMP
                            )';
            $connection->exec($createTableSql);
            echo 'Created Table Products Successfully' . PHP_EOL;
            $addForeignKeySql = 'ALTER TABLE products
                                 ADD CONSTRAINT FK_ProductType
                                 FOREIGN KEY (product_type_id) REFERENCES product_types(id)';
            $connection->exec($addForeignKeySql);
            echo 'Added Product Type Id Foreign Key Successfully' . PHP_EOL;
        } catch (\PDOException $e) {
            echo 'Failed To Create Products Table: ' . PHP_EOL . $e->getMessage();
        }
    }

    public static function migrateDown()
    {
        try {
            $connection = Connection::connectToDatabase();
            $dropTableSql = 'ALTER TABLE products
                             DROP FOREIGN KEY FK_ProductType;
                             DROP TABLE products';
            $connection->exec($dropTableSql);
            echo 'Dropped Table Products Successfully' . PHP_EOL;
        } catch (\PDOException $e) {
            echo 'Failed To Drop Products Table: ' . PHP_EOL . $e->getMessage();
        }
    }
}