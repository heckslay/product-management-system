<?php

namespace database;

use PDO;
use PDOException;

class Connection
{
    /**
     * @return PDO
     * Initializes a database connection using PDO.
     */
    public static function connectToDatabase()
    {
        $databaseConfig = include __DIR__ . '/../env.php';
        try {
            $connection = new PDO($databaseConfig['DB_DSN'], $databaseConfig['DB_USERNAME'], $databaseConfig['DB_PASSWORD']);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            echo 'Database Connection Error Occurred';
        }
    }
}