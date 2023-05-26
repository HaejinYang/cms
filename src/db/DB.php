<?php

class DB
{
    private static $instance = null;

    public static function &getInstance(): mysqli
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        if (self::$instance === null) {
            $env = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/.env');
            self::$instance = new mysqli($env['DB_HOST'], $env['DB_USER_ID'], $env['DB_USER_PASSWORD'], $env['DB_NAME'], $env['DB_PORT']);
            if (self::$instance->connect_errno) {
                throw new Exception('Can not connect database: ' . self::$instance->connect_errno);
            }
        }

        return self::$instance;
    }

    public static function __callStatic($method, $args)
    {
        return call_user_func_array(array(self::getInstance(), $method), $args);
    }
}