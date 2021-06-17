<?php

namespace IESLaCierva\Infrastructure\Database;

class Connection
{

    private static ?\PDO $instance = null;

    private function __construct()
    {
//       self::$instance = new \PDO("mysql:host=mysql;port=3306;dbname=posts","root","admin1234",[]);
        self::$instance = new \PDO($_SERVER['MYSQL_DSN'], $_SERVER['MYSQL_USER'], $_SERVER['MYSQL_PASSWORD'], []);
    }

    public static function create(): \PDO
    {
        if (null === self::$instance) {
            new self();
        }
        
        return self::$instance;
    }
}
