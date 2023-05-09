<?php

namespace System;

use PDO;

class DB
{
    private static $db;
    public function __construct($database, $options = null)
    {
        try {
            $host = $database['host'];
            $dbname = $database['database'];
            $user = $database['user'];
            $password = $database['password'];
            $options = $options ?? [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            static::$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password, $options);
        } catch (\PDOException $e) {
            throw new \PDOException();
        }
    }

    public function getInstance()
    {
        return static::$db;
    }
}
