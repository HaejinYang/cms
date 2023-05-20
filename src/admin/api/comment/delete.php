<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/comment.php';

do {
    if (!isset($_GET['id'])) {
        break;
    }

    $comment_id = $_GET['id'];
    try {
        $comment = new Comment();
        $comment->delete($comment_id);
    } catch (mysqli_sql_exception $e) {
        echo $e->getMessage();
    }
} while (false);

header("Location: /admin/page/comment/index.php");