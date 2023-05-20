<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

class Comment extends DB
{
    public function create()
    {

    }

    public function read(int $id)
    {
        $query = "SELECT * FROM comment WHERE id = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        return $result->fetch_assoc();
    }

    public function readAll()
    {
        $query = "SELECT * FROM comment";
        $result = self::query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function update(int $id)
    {

    }

    public function delete(int $id)
    {
        $query = "DELETE FROM comment WHERE id = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
