<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

class User extends DB
{
    public function create()
    {

    }

    public function read()
    {

    }

    public function readAll(): array
    {
        $query = "SELECT * FROM user";
        $result = self::query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}