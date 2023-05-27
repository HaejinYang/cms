<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/db/DB.php';

class PostStore extends DB
{
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

    public function read(int $id): array|null
    {
        $stmt = self::prepare("SELECT * FROM post WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function readByCategoryId(int $id, int $max_count = 3): array|null
    {
        $stmt = self::prepare("SELECT * FROM post WHERE category_id = ? LIMIT ?");
        $stmt->bind_param("ii", $id, $max_count);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function readAll(int $max_count = 3): array
    {
        $result = self::query("SELECT * FROM post LIMIT {$max_count}");

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function readByAuthor(string $author): array
    {
        $converted_author = $author; //'%' . $author . '%';
        $stmt = self::prepare("SELECT * FROM post WHERE author LIKE ?");
        $stmt->bind_param("s", $converted_author);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function countAllPosts(): int
    {
        $result = self::query("SELECT COUNT(*) FROM post");
        $row = $result->fetch_array();

        return $row[0];
    }

    public function countAllDraft(): int
    {
        $result = self::query("SELECT COUNT(*) FROM post WHERE status = 'draft'");
        $row = $result->fetch_array();

        return $row[0];
    }

    public function countAllPublish(): int
    {
        $result = self::query("SELECT COUNT(*) FROM post WHERE status = 'published'");
        $row = $result->fetch_array();

        return $row[0];
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

    public function updateStatus(int $id, string $status)
    {
        $query = "UPDATE post SET status = ? WHERE id = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM post WHERE id = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getLastCreateId(): int
    {
        return self::getInstance()->insert_id;
    }

    /*
     * 모든 게시글이 가질 수 있는 공개 상태를 반환한다.
     */
    public static function getStatus(): array
    {
        $status = ["draft" => "보류", "published" => "공개"];

        return $status;
    }

    public static function isPublished($status): bool
    {
        return $status === "published";
    }
}
