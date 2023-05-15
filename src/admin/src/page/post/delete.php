<?php

do {
    if (!isset($_GET['id'])) {
        break;
    }

    require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/src/model/post.php';

    $post = new Post();
    $post->delete($_GET['id']);

} while (false);

header("Location: /admin/src/page/post/view.php");