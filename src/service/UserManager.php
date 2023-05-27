<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/UserStore.php';

class UserManager
{
    const ERROR_OK = 0;
    const ERROR_DB_ERROR = 1;
    const ERROR_NO_ACCOUNT = 2;
    const ERROR_PASSWORD = 3;
    private string $account;
    private string $password;

    public function login(&$user, string $account, string $password): int
    {
        try {
            $user_dao = new UserStore();
            $result = $user_dao->readByAccount($user, $account);
            if ($result !== UserStore::ERROR_OK) {
                return self::ERROR_NO_ACCOUNT;
            }

            if ($user['password'] !== $password) {
                return self::ERROR_PASSWORD;
            }
        } catch (mysqli_sql_exception $e) {
            return self::ERROR_DB_ERROR;
        }

        return self::ERROR_OK;
    }

    public function isAdmin(): bool
    {
        return session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }

    public function getErrorCode()
    {

    }

    public function getErrorMessage()
    {

    }
}