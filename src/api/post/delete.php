<?php

do {
    if (!isset($_GET['id'])) {
        break;
    }

    require_once $_SERVER['DOCUMENT_ROOT'] . '/model/PostStore.php';

    $post = new PostStore();
    $post->delete($_GET['id']);

} while (false);

header("Location: /admin/page/post/index.php");