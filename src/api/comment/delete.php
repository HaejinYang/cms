<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/CommentStore.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/util/response.php';

$is_success = false;
$response_msg = "";
do {
    if (!isset($_GET['id'])) {
        $response_msg = "잘못된 요청입니다.";

        break;
    }

    $comment_id = $_GET['id'];
    try {
        $comment_store = new CommentStore();
        $result = $comment_store->delete($comment_id);
        if ($result !== CommentStore::ERROR_OK) {
            $response_msg = "서버 내부 오류입니다.";
        }

        $is_success = true;
    } catch (mysqli_sql_exception $e) {
        $response_msg = "서버 내부 오류입니다.";
    }
} while (false);

if ($is_success) {
    header("Location: /admin/page/comment/index.php");
} else {
    echo goBackWithResponse($response_msg);
}
