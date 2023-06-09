<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/service/UserManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/util/response.php';
$response_msg = "";
$is_complete = false;
do {
    if (!isset($_POST['login'])) {
        $response_msg = "잘못된 요청입니다.";

        break;
    }
    $account = $_POST['account'];
    $password = $_POST['password'];
    $user_manager = new UserManager();
    $result = $user_manager->login($user, $account, $password);
    if ($result !== UserManager::ERROR_OK) {
        $response_msg = "로그인이 실패하였습니다.";

        break;
    }

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_account'] = $user['account'];
    $_SESSION['user_lastname'] = $user['lastname'];
    $_SESSION['user_firstname'] = $user['firstname'];
    $_SESSION['user_role'] = $user['role'];

    $is_complete = true;
} while (false);

if ($is_complete) {
    header("Location: /admin/index.php");
} else {
    echo goBackWithAlert($response_msg);
}