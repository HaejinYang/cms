<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

class User extends DB
{
    const ERROR_OK = 0;
    const ERROR_PASSWORD = 1;
    const ERROR_EMAIL = 2;
    const ERROR_NICKNAME = 3;
    const ERROR_ID = 4;

    public function create(string $nickname, string $password, string $password_check, string $lastname, string $firstname, string $email, string $role): int
    {
        if ($this->isInvalidPassword($password, $password_check)) {
            return self::ERROR_PASSWORD;
        }

        if ($this->isDuplicateEmail($email)) {
            return self::ERROR_EMAIL;
        }

        if ($this->isDuplicateNickname($nickname)) {
            return self::ERROR_NICKNAME;
        }

        $query = "INSERT INTO user(nickname, password, lastname, firstname, email, role) VALUES(?, ?, ?, ?, ?, ?)";
        $stmt = self::prepare($query);
        $stmt->bind_param("ssssss", $nickname, $password, $lastname, $firstname, $email, $role);
        $stmt->execute();

        return self::ERROR_OK;
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

    public function delete(int $id): int
    {
        if (!is_numeric($id)) {
            return self::ERROR_ID;
        }

        $query = "DELETE FROM user WHERE id = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return self::ERROR_OK;
    }

    /*
     * 유저 역할(admin ...)등을 모두 반환한다.
     */
    public static function getAllRole(): array
    {
        $role = ["admin" => "관리자", "subscriber" => "구독자"];

        return $role;
    }

    public static function getErrorCodeToMsg($code): string
    {
        $msg = "";
        switch ($code) {
            case self::ERROR_OK:
                $msg = "정상";
                break;
            case self::ERROR_PASSWORD:
                $msg = "비밀번호를 확인해주세요.";
                break;
            case self::ERROR_EMAIL:
                $msg = "이메일 중복을 확인해주세요.";
                break;
            case self::ERROR_NICKNAME:
                $msg = "닉네임 중복을 확인해주세요.";
                break;
            case self::ERROR_ID:
                $msg = "ID를 확인해주세요.";
                break;
            default:
                $msg = "정의되지 않은 에러입니다.";
                break;
        }

        return $msg;
    }

    private function isDuplicateNickname($nickname): bool
    {
        $query = "SELECT * FROM user WHERE nickname = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("s", $nickname);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows !== 0;
    }

    private function isDuplicateEmail(string $email): bool
    {
        $query = "SELECT * FROM user WHERE email = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows !== 0;
    }

    private function isInvalidPassword(string $password, string $password_check): bool
    {
        return empty($password) || empty($password_check) || $password !== $password_check;
    }
}