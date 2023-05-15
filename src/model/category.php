<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

/*
 * psr: class name PascalNaming, method camelCase, constant CONSTANT_NAME,
 * property, variable not defined. 그런데, 구별을 위해 스네이크가 나아보임.
 */

class Category extends DB
{
    public static function create($title): bool
    {
        $query = "INSERT INTO category(title) VALUES(?)";
        $stmt = self::prepare($query);
        $stmt->bind_param("s", $title);
        return $stmt->execute();
    }

    public static function read(int $id): string
    {
        $query = "SELECT * FROM category WHERE id = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("i", $id);
        $isSuccess = $stmt->execute();

        if (!$isSuccess) {
            return "";
        }

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['title'];
    }

    public static function readAll()
    {
        return self::query("SELECT * FROM category");
    }

    public static function update(int $id, string $title): bool
    {
        $query = "UPDATE category SET title=? WHERE id=?";
        $stmt = self::prepare($query);
        $stmt->bind_param("si", $title, $id);
        return $stmt->execute();
    }

    public static function delete(int $id): bool
    {
        $query = "DELETE FROM category WHERE id = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}