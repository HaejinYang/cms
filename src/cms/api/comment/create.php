<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/comment.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/post.php';

$post_id = null;
do {
    if (!isset($_POST['create'])) {
        break;
    }

    $author = $_POST['author'];
    $email = $_POST['email'];
    $content = $_POST['content'];
    $date = date('y-m-d');
    $post_id = $_POST['post_id'];
    $status = 'draft';
    $comment_dao = new Comment();
    $comment_dao->create($post_id, $author, $email, $content, $status, $date);

    $post_dao = new Post();
    $post_dao->updateCommentCount($post_id);

} while (false);

header("Location: /cms/page/post/index.php?id={$post_id}");