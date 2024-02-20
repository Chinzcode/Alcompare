<?php

namespace Alcompare\classes\Database;

use PDO;
use PDOException;

/**
 * Class DB
 */
class Database
{
    private const DB_HOST = "localhost";
    private const DB_NAME = "Alcompare";
    private const DB_USERNAME = "root";
    private const DB_PASSWORD = "123";

    public static function getDb()
    {
        try {
            $pdo = new PDO("mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME, self::DB_USERNAME, self::DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Connection failed:" . $e->getMessage());
        }
    }
}
