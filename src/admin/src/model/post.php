<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

class Post extends DB
{
    private $result;

    function __constructor()
    {
        $this->result = null;
    }

    public function create($title, $category_id, $author, )
    {

    }

    public function read(int $id): bool|array
    {
        $stmt = self::prepare("SELECT * FROM post WHERE id = ?");
        $stmt->bind_param("i", $id);
        $isSuccess = $stmt->execute();
        if (!$isSuccess) {
            return false;
        }

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function readAll()
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

    public function update()
    {

    }

    public function delete()
    {

    }
}
