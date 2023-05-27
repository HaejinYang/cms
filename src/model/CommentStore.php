<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/DB.php';

class CommentStore extends DB
{
    const ERROR_OK = 0;
    const ERROR_FAIL = 1;

    public function create(int $post_id, string $author, string $email, string $content, string $status, string $date): int
    {
        $query = "INSERT INTO comment(post_id, author, email, content, status, date) VALUES(?, ?, ?, ?, ?, ?)";
        $stmt = self::prepare($query);
        $stmt->bind_param("isssss", $post_id, $author, $email, $content, $status, $date);

        if (!$stmt->execute()) {
            return self::ERROR_FAIL;
        }

        return self::ERROR_OK;
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

    public function countAllComments(): int
    {
        $result = self::query("SELECT COUNT(*) FROM comment");
        $row = $result->fetch_array();

        return $row[0];
    }

    public function countAllApproved(): int
    {
        $result = self::query("SELECT COUNT(*) FROM comment WHERE status = 'approve'");
        $row = $result->fetch_array();

        return $row[0];
    }

    public function countAllUnapproved(): int
    {
        $result = self::query("SELECT COUNT(*) FROM comment WHERE status = 'unapprove'");
        $row = $result->fetch_array();

        return $row[0];
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
