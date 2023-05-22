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

    /*
     * 유저 역할(admin ...)등을 모두 반환한다.
     */
    public static function getAllRole(): array
    {
        $role = ["admin" => "관리자", "subscriber" => "구독자"];

        return $role;
    }
}