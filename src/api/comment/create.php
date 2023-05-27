<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/CommentStore.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/PostStore.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/util/response.php';

$post_id = null;
$is_success = false;
$response_msg = "";
do {
    if (!isset($_POST['create'])) {
        $response_msg = "잘못된 요청입니다.";

        break;
    }

    $author = $_POST['author'];
    $email = $_POST['email'];
    $content = $_POST['content'];

    if (empty($author) || empty($email) || empty($content)) {
        $response_msg = "댓글을 확인해주세요";

        break;
    }

    $date = date('y-m-d');
    $post_id = $_POST['post_id'];
    $status = 'draft';

    try {
        $comment_dao = new CommentStore();
        $result = $comment_dao->create($post_id, $author, $email, $content, $status, $date);
        if ($result !== CommentStore::ERROR_OK) {
            $response_msg = "서버 내부 오류입니다.";

            break;
        }

        $post_dao = new PostStore();
        $result = $post_dao->updateCommentCount($post_id);
        if ($result !== PostStore::ERROR_OK) {
            $response_msg = "서버 내부 오류입니다.";

            break;
        }

        $is_success = true;
    } catch (mysqli_sql_exception $e) {
        $response_msg = "서버 내부 오류입니다.";
    }
} while (false);

if ($is_success) {
    header("Location: /cms/page/post/index.php?id={$post_id}");
} else {
    echo goBackWithResponse($response_msg);
}