<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/UserStore.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/util/response.php';

$response_msg = "가입 요청이 제출되었습니다.";
$is_success = false;
do {
    if (!isset($_POST['register'])) {
        $response_msg = "잘못된 요청입니다.";

        break;
    }

    $account = $_POST['account'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_check = $_POST['password_check'];

    if (empty($account) || empty($email) || empty($password) || empty($password_check) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response_msg = "입력한 내용을 확인해주세요.";

        break;
    }

    try {
        $user_store = new UserStore();
        if ($user_store->isDuplicated($account, $email)) {
            $response_msg = "아이디와 이메일 중복을 확인해주세요.";

            break;
        }

        $role = 'subscriber';
        $result = $user_store->create($account, $password, $password_check, "", "", $email, $role);
        if ($result !== UserStore::ERROR_OK) {
            $response_msg = UserStore::getErrorCodeToMsg($result);

            break;
        }
        $is_success = true;
    } catch (mysqli_sql_exception $e) {
        $response_msg = "서버 내부 오류입니다.";
    }
} while (false);

echo goBackWithSession(["API_RESPONSE" => $response_msg]);