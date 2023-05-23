<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/Comment.php';

do {
    if (!isset($_GET['id'])) {
        break;
    }

    $id = $_GET['id'];
    $status = "unapprove";

    $comment_dao = new Comment();
    $comment_dao->updateStatus($id, $status);
} while (false);

header("Location: /admin/page/comment/index.php");
