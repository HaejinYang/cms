<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/UserStore.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/util/response.php';
$response_msg = "";
$isSuccess = false;
do {
    if (!isset($_POST['create'])) {
        $response_msg = "잘못된 호출입니다.";

        break;
    }

    try {
        $user_dao = new UserStore();
        $result = $user_dao->create($_POST['account'], $_POST['password'], $_POST['password_check'], $_POST['lastname'], $_POST['firstname'], $_POST['email'], $_POST['role']);
        if ($result !== UserStore::ERROR_OK) {
            $response_msg = UserStore::getErrorCodeToMsg($result);

            break;
        }

        $isSuccess = true;
    } catch (mysqli_sql_exception $e) {
        $response_msg = "입력값을 다시 확인해주세요.";
    }
} while (false);

if ($isSuccess) {
    header("Location: /admin/page/user/index.php");
} else {
    echo goBackWithResponse($response_msg);
}
