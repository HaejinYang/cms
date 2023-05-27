<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/UserStore.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/util/response.php';
$response_msg = "";
$is_success = false;
do {
    if (!isset($_GET['id'])) {
        $response_msg = "잘못된 요청입니다.";

        break;
    }
    $id = $_GET['id'];
    try {
        $user_dao = new UserStore();
        $result = $user_dao->delete($id);
        if ($result !== UserStore::ERROR_OK) {
            $response_msg = UserStore::getErrorCodeToMsg($result);

            break;
        }

        $is_success = true;
    } catch (mysqli_sql_exception $e) {
        $response_msg = $e->getMessage();
    }
} while (false);

if ($is_success) {
    header("Location: /admin/page/user/index.php");
} else {
    echo goBackWithAlert($response_msg);
}