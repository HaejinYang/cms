<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
class DB
{
    private static $instance = null;

    private static function instance()
    {
        if (self::$instance === null) {
            $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
            $dotenv->load();

            self::$instance = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER_ID'], $_ENV['DB_USER_PASSWORD'], $_ENV['DB_NAME'], $_ENV['DB_PORT']);
            if (self::$instance->connect_errno) {
                throw new Exception('dberror: ' . self::$instance->connect_errno);
            }

            return self::$instance;
        }
    }

    public static function __callStatic($method, $args)
    {
        return call_user_func_array(array(self::instance(), $method), $args);
    }
}