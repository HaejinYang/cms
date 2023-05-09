<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/db/db.php';
$result = '';

if(isset($_POST['search'])) {
    $result = DB::query("SELECT * FROM post WHERE tags LIKE '%{$_POST['search']}%'");
} else {
    $result = DB::query("SELECT * FROM post");
}

$el = "";
while($post = $result->fetch_assoc()) {
    $html = <<<EOT
                            <h2>
                                <a href="#">{$post['title']}</a>
                            </h2>
                            <p class="lead">
                                    by <a href="index.php">{$post['author']}</a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on {$post['date']}</p>
                            <hr>
                            <img class="img-responsive" src="{$post['image']}" alt="">
                            <hr>
                            <p>{$post['content']}</p>
                            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            
                            <hr>
EOT;
    $el .= $html;
}

echo $el;