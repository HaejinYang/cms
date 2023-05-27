<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/UserStore.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/util/response.php';

$response_msg = "";
$is_success = false;
do {
    if (!isset($_POST['edit'])) {
        $response_msg = "잘못된 요청입니다.";

        break;
    }

    try {
        $user_dao = new UserStore();
        $result = $user_dao->read($user, $_POST['id']);
        if ($result !== UserStore::ERROR_OK) {
            $response_msg = UserStore::getErrorCodeToMsg($result);

            break;
        }

        $password = $_POST['password'];
        $password_check = $_POST['password_check'];
        if (empty($password) && empty($password_check)) {
            $password = $user['password'];
            $password_check = $password;
        }

        $result = $user_dao->update($_POST['id'], $_POST['account'], $password, $password_check, $_POST['lastname'],
            $_POST['firstname'], $_POST['email'], $_POST['role']);
        if ($result !== UserStore::ERROR_OK) {
            $response_msg = UserStore::getErrorCodeToMsg($result);

            break;
        }
    } catch (mysqli_sql_exception $e) {
        $response_msg = "잘못된 요청입니다.";
    }

    $is_success = true;
} while (false);

if ($is_success) {
    header("Location: /admin/page/user/index.php");
} else {
    echo goBackWithAlert($response_msg);
}