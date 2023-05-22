<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

class Comment extends DB
{
    public function create(int $post_id, string $author, string $email, string $content, string $status, string $date): bool
    {
        $query = "INSERT INTO comment(post_id, author, email, content, status, date) VALUES(?, ?, ?, ?, ?, ?)";
        $stmt = self::prepare($query);
        $stmt->bind_param("isssss", $post_id, $author, $email, $content, $status, $date);

        return $stmt->execute();
    }

    public function read(int $id)
    {
        $query = "SELECT * FROM comment WHERE id = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        return $result->fetch_assoc();
    }

    public function readByPostId(int $id)
    {
        $query = "SELECT * FROM comment WHERE post_id = ? ORDER BY date DESC";
        $stmt = self::prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function readAll()
    {
        $query = "SELECT * FROM comment";
        $result = self::query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /*
     * status: approve, unapprove
     */
    public function updateStatus(int $id, string $status)
    {
        $query = "UPDATE comment SET status = ? WHERE id = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM comment WHERE id = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}
