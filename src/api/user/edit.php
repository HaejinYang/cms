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
        $user_store = new UserStore();
        $result = $user_store->read($user, $_POST['id']);
        if ($result !== UserStore::ERROR_OK) {
            $response_msg = UserStore::getErrorCodeToMsg($result);

            break;
        }

        $result = $user_store->update($_POST['id'], $_POST['account'], $_POST['lastname'], $_POST['firstname'], $_POST['email'], $_POST['role']);
        if ($result !== UserStore::ERROR_OK) {
            $response_msg = UserStore::getErrorCodeToMsg($result);

            break;
        }

        if (!empty($_POST['password']) && !empty($_POST['password_check'])) {
            $result = $user_store->updatePassword($_POST['id'], $_POST['password'], $_POST['password_check']);
            if ($result !== UserStore::ERROR_OK) {
                $response_msg = UserStore::getErrorCodeToMsg($result);

                break;
            }
        }

        $is_success = true;
    } catch (mysqli_sql_exception $e) {
        $response_msg = "잘못된 요청입니다.";
    }
} while (false);

if ($is_success) {
    header("Location: /admin/page/user/index.php");
} else {
    echo goBackWithAlert($response_msg);
}