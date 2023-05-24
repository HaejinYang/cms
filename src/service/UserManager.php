<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/UserStore.php';

class UserManager
{
    private string $account;
    private string $password;

    public function __construct(string $account, string $password)
    {
        $this->account = $account;
        $this->password = $password;
    }

    public function login(): bool
    {
        try {
            $user_dao = new UserStore();
            $result = $user_dao->readByAccount($user, $this->account);
            if ($result !== UserStore::ERROR_OK) {
                return false;
            }
        } catch (mysqli_sql_exception $e) {
            return false;
        }

        return true;
    }

    public function getErrorCode()
    {

    }

    public function getErrorMessage()
    {

    }
}