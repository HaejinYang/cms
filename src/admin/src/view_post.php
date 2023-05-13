<?php
if (!isset($_GET['id'])) {
    return;
}

require_once __DIR__ . '/model/post.php';
$id = $_GET['id'];

$post = new Post();
$row = $post->read($id);

var_dump($row);

