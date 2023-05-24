<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/CommentStore.php';

do {
    if (!isset($_GET['id'])) {
        break;
    }

    $id = $_GET['id'];
    $status = "approve";

    $comment_dao = new CommentStore();
    $comment_dao->updateStatus($id, $status);
} while (false);

header("Location: /admin/page/comment/index.php");

