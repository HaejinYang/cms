<?php
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
    $user = new UserManager($account, $password);
    $result = $user->login();
    if (!$result) {
        $response_msg = "로그인이 실패하였습니다.";

        break;
    }

    $is_complete = true;
} while (false);

if ($is_complete) {
    echo goBackWithResponse("성공");

    //header("Location: /cms/index.php");
} else {
    echo goBackWithResponse($response_msg);
}