<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/DB.php';

class UserStore extends DB
{
    const ERROR_OK = 0;
    const ERROR_PASSWORD = 1;
    const ERROR_EMAIL = 2;
    const ERROR_ACCOUNT = 3;
    const ERROR_ID = 4;
    const ERROR_ROLE = 5;

    private string $salt;
    private int $timezone_correction;

    public function __construct()
    {
        $env = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/.env');
        $this->salt = $env['SALT'];
        $this->timezone_correction = $env['TIMEZONE_CORRECTION'];
    }

    public function create(string $account, string $password, string $password_check, string $lastname, string $firstname, string $email, string $role): int
    {
        if ($this->isInvalidPassword($password, $password_check)) {
            return self::ERROR_PASSWORD;
        }

        if ($this->isDuplicateEmail($email)) {
            return self::ERROR_EMAIL;
        }

        if ($this->isDuplicateAccount($account)) {
            return self::ERROR_ACCOUNT;
        }

        $env = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/.env');

        $salted_password = crypt($password, $this->salt);
        $registered_at = date('Y-m-d H:i:s', time() + $this->timezone_correction);
        $updated_at = $registered_at;

        $query = "INSERT INTO user(account, password, lastname, firstname, email, role, registered_at, updated_at) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = self::prepare($query);
        $stmt->bind_param("ssssssss", $account, $salted_password, $lastname, $firstname, $email, $role, $registered_at, $updated_at);
        $stmt->execute();

        return self::ERROR_OK;
    }

    public function read(&$user, int $id): int
    {
        if (!is_numeric($id)) {
            return self::ERROR_ID;
        }

        $query = "SELECT * FROM user WHERE id = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        if ($user === null) {
            return self::ERROR_ID;
        }

        return self::ERROR_OK;
    }

    public function readByAccount(&$user, string $account): int
    {
        if (!empty($string)) {
            return self::ERROR_ACCOUNT;
        }

        $query = "SELECT * FROM user WHERE account = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("s", $account);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        if ($user === null) {
            return self::ERROR_ACCOUNT;
        }

        return self::ERROR_OK;
    }

    public function readAll(): array
    {
        $query = "SELECT * FROM user";
        $result = self::query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function countAllUsers(): int
    {
        $result = self::query("SELECT COUNT(*) FROM user");
        $row = $result->fetch_array();

        return $row[0];
    }

    public function countAllSubscribers(): int
    {
        $result = self::query("SELECT COUNT(*) FROM user WHERE role = 'subscriber'");
        $row = $result->fetch_array();

        return $row[0];
    }

    public function countAllAdmins(): int
    {
        $result = self::query("SELECT COUNT(*) FROM user WHERE role = 'admin'");
        $row = $result->fetch_array();

        return $row[0];
    }

    public function update(int $id, string $account, string $password, string $password_check, string $lastname, string $firstname, string $email, string $role): int
    {
        if ($this->isInvalidPassword($password, $password_check)) {
            return self::ERROR_PASSWORD;
        }

        if ($this->isDuplicateEmail($email, $id)) {
            return self::ERROR_EMAIL;
        }

        if ($this->isDuplicateAccount($account, $id)) {
            return self::ERROR_ACCOUNT;
        }

        $salted_password = crypt($password, $this->salt);
        $updated_at = date('Y-m-d H:i:s', time() + $this->timezone_correction);

        $query = "UPDATE user SET account = ?, password = ?, lastname = ?, firstname = ?, email = ?, role = ?, updated_at = ? WHERE id = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("sssssssi", $account, $salted_password, $lastname, $firstname, $email, $role, $updated_at,);
        $stmt->execute();

        return self::ERROR_OK;
    }

    public function updateRole(int $id, string $role): int
    {
        if (!is_numeric($id)) {
            return self::ERROR_ID;
        }

        if ($this->isInvalidRole($role)) {
            return self::ERROR_ROLE;
        }

        $updated_at = date('Y-m-d H:i:s', time() + $this->timezone_correction);

        $query = "UPDATE user SET role = ?, updated_at = ? WHERE id = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("ssi", $role, $updated_at, $id);
        $stmt->execute();

        return self::ERROR_OK;
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
            case self::ERROR_ACCOUNT:
                $msg = "계정 중복을 확인해주세요.";
                break;
            case self::ERROR_ID:
                $msg = "ID를 확인해주세요.";
                break;
            case self::ERROR_ROLE:
                $msg = "역할을 확인해주세요.";
                break;
            default:
                $msg = "정의되지 않은 에러입니다.";
                break;
        }

        return $msg;
    }

    public function isDuplicated(string $account, string $email): bool
    {
        $query = "SELECT * FROM user WHERE account = ? OR email = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("ss", $account, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows !== 0;
    }

    public function isSamePassword(string $request, string $hashed): bool
    {
        $compared = crypt($request, $this->salt);

        return hash_equals($hashed, $compared);
    }

    private function isDuplicateAccount(string $account, int $except_id = -1): bool
    {
        $query = "SELECT * FROM user WHERE account = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("s", $account);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            return false;
        }

        $row = $result->fetch_assoc();
        if ($row['id'] === $except_id) {
            return false;
        }

        return true;
    }

    private function isDuplicateEmail(string $email, int $except_id = -1): bool
    {
        $query = "SELECT * FROM user WHERE email = ?";
        $stmt = self::prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            return false;
        }

        $row = $result->fetch_assoc();
        if ($row['id'] === $except_id) {
            return false;
        }

        return true;
    }

    private function isInvalidPassword(string $password, string $password_check): bool
    {
        return empty($password) || empty($password_check) || $password !== $password_check;
    }

    private function isInvalidRole(string $role): bool
    {
        $list = $this->getRoles();

        return !isset($list[$role]);
    }

    public static function getRoles(): array
    {
        $list = ["admin" => "관리자", "subscriber" => "구독자"];

        return $list;
    }
}