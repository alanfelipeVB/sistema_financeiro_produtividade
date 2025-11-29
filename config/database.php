<?php

require_once __DIR__ . '/../env.php';

class Database
{
    private static $host = 'localhost';
    private static $db_name;
    private static $username;
    private static $password;
    private static $conn;

    public static function init()
    {
        $env = new Env();
        self::$db_name = $env->dbName;
        self::$username = $env->dbUser;
        self::$password = $env->dbPswd;
    }

    public static function connect()
    {
        if (!isset(self::$db_name)) {
            self::init();
        }

        try {
            self::$conn = new PDO(
                'mysql:host=' . self::$host . ';dbname=' . self::$db_name,
                self::$username,
                self::$password
            );
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo 'Connection error: ' . $exception->getMessage();
        }

        return self::$conn;
    }

    public static function getConnection()
    {
        return self::$conn;
    }
}
