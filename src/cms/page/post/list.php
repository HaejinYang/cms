<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/post.php';

$post = new Post();
$result = null;
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $result = $post->readByCategoryId($category_id);
} else {
    $result = $post->readAll();
}

$postCount = 0;
const MAX_POST_COUNT = 3;
$el = "";
while ($row = $result->next()) {
    $postCount++;
    if ($postCount > MAX_POST_COUNT) {
        break;
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
}

return $el;