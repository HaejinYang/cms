<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/PostStore.php';

$post = new PostStore();
$rows = null;
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $rows = $post->readByCategoryId($category_id);
} else {
    $rows = $post->readAll();
}

$postCount = 0;
const MAX_POST_COUNT = 3;
$el = "";
foreach ($rows as $row) {
    if ($postCount >= MAX_POST_COUNT) {
        break;
    }
    $status = $row['status'];
    if (!PostStore::isPublished($status)) {
        continue;
    }

    $content = substr($row['content'], 0, 10) . "...";
    $html = <<<EOT
                <h2>
                <a href="/cms/page/post/index.php?id={$row['id']}">{$row['title']}</a>
                </h2>
                <p class="lead">
                    by <a href="index.php">{$row['author']}</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on {$row['date']}</p>
                <hr>
                <img class="img-responsive" src="/{$row['image']}" alt="">
                <hr>
                <p>{$content}</p>
                <a class="btn btn-primary" href="/cms/page/post/index.php?id={$row['id']}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
EOT;
    $el .= $html;

    $postCount++;
}

return $el;