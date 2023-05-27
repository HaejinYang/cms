<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/UserStore.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/util/response.php';

$response_msg = "";
$is_success = false;
do {
    if (!isset($_GET['id']) || !isset($_GET['role'])) {
        $response_msg = "올바른 요청이 아닙니다.";

        break;
    }
    $id = $_GET['id'];
    $role = $_GET['role'];
    try {
        $user_dao = new UserStore();
        $result = $user_dao->updateRole($id, $role);
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