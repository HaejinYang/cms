<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/PostStore.php';

$post = new PostStore();
$rows = null;
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $rows = $post->readByCategoryId($category_id);
} else if (isset($_GET['author'])) {
    $author = $_GET['author'];
    $rows = $post->readByAuthor($author);
} else {
    $rows = $post->readAll();
}

if ($rows === null) {
    echo "<h1> 게시글이 없습니다.</h1>";

    return;
}

$el = "";
foreach ($rows as $row) {
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
                    by <a href="/cms/index.php?author={$row['author']}">{$row['author']}</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on {$row['date']}</p>
                <hr>
                <a href="/cms/page/post/index.php?id={$row['id']}"><img class="img-responsive" src="/{$row['image']} " alt=""></a>
                <hr>
                <p>{$content}</p>
                <a class="btn btn-primary" href="/cms/page/post/index.php?id={$row['id']}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
EOT;
    $el .= $html;
}

return $el;