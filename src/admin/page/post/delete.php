<?php

do {
    if (!isset($_GET['id'])) {
        break;
    }

    require_once $_SERVER['DOCUMENT_ROOT'] . '/model/post.php';

    $post = new Post();
    $post->delete($_GET['id']);

} while (false);

header("Location: /admin/page/post/view.php");