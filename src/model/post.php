<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/db/DB.php';

class Post extends DB
{
    private $result;

    function __constructor()
    {
        $this->result = null;
    }

    public function create(string $title, int $category_id, string $author, string $status, string $tags,
                           string $content, string $image, string $image_temp_path, string $date, string $comment_count): bool
    {
        $image_path = 'images/' . $image;
        $query = "INSERT INTO post(title, category_id, author, status, tags, content, image, date, comment_count) 
VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = self::prepare($query);
        $stmt->bind_param("sissssssi", $title, $category_id, $author, $status, $tags, $content, $image_path, $date, $comment_count);
        $result = $stmt->execute();

        move_uploaded_file($image_temp_path, $_SERVER['DOCUMENT_ROOT'] . '/images/' . $image);

        return $result;
    }

    public function read(int $id): bool|array
    {
        $stmt = self::prepare("SELECT * FROM post WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function readByCategoryId(int $id): Post
    {
        $stmt = self::prepare("SELECT * FROM post WHERE category_id = ?");
        $stmt->bind_param("i", $id);
        $isSuccess = $stmt->execute();
        if (!$isSuccess) {
            return false;
        }

        $this->result = $stmt->get_result();

        return $this;
    }

    public function readAll(): Post
    {
        $this->result = self::query("SELECT * FROM post");

        return $this;
    }

    public function next(): bool|array
    {
        if (!$this->result) {
            return false;
        }

        $row = $this->result->fetch_assoc();
        if (!$row) {
            $this->result = null;

            return false;
        }

        return $row;
    }

    /*
     * 이미지가 변경되지 않았다면, $image_temp_path에 빈문자열 대입
     */
    public function update(int    $id, string $title, int $category_id, string $author, string $status, string $tags,
                           string $content, string $date, string $comment_count): bool
    {
        $query = "UPDATE post SET title = ?, category_id = ?, author = ?, status = ?, tags = ?, content = ?, date = ?, comment_count = ? WHERE id = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("sisssssii", $title, $category_id, $author, $status, $tags, $content, $date, $comment_count, $id);
        $result = $stmt->execute();

        return $result;
    }

    public function updateWithImage(int    $id, string $title, int $category_id, string $author, string $status, string $tags,
                                    string $content, string $image, string $image_temp_path, string $date, string $comment_count): bool
    {
        $image_path = 'images/' . $image;
        $query = "UPDATE post SET title = ?, category_id = ?, author = ?, status = ?, tags = ?, content = ?, image = ?, date = ?, comment_count = ? WHERE id = ?";

        $stmt = self::prepare($query);
        $stmt->bind_param("sissssssii", $title, $category_id, $author, $status, $tags, $content, $image_path, $date, $comment_count, $id);
        $result = $stmt->execute();

        move_uploaded_file($image_temp_path, $_SERVER['DOCUMENT_ROOT'] . '/images/' . $image);

        return $result;
    }

    public function updateCommentCount(int $id)
    {
        $query = "UPDATE post SET comment_count = comment_count + 1 WHERE id = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM post WHERE id = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    /*
     * 모든 게시글이 가질 수 있는 공개 상태를 반환한다.
     */
    public static function getStatus(): array
    {
        $status = ["draft" => "보류", "publish" => "공개"];

        return $status;
    }

    public static function isPublished($status): bool
    {
        return $status === "publish";
    }
}
