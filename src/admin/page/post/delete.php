<?php

do {
    if (!isset($_GET['id'])) {
        break;
    }

    require_once $_SERVER['DOCUMENT_ROOT'] . '/model/Post.php';

    $post = new Post();
    $post->delete($_GET['id']);

} while (false);

header("Location: /admin/page/post/index.php");