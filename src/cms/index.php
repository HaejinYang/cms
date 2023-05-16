<!-- header -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/cms/src/header.php'; ?>

<!-- Navigation -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/cms/src/navigation.php'; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <?php
            require_once $_SERVER['DOCUMENT_ROOT'] . '/model/post.php';
            $post = new Post();
            $result = $post->readAll();
            $postCount = 0;
            const MAX_POST_COUNT = 3;
            while ($row = $result->next()) {
                $postCount++;
                if ($postCount > MAX_POST_COUNT) {
                    break;
                }
                $content = substr($row['content'], 0, 10) . "...";
                $html = <<<EOT
                <h2>
                <a href="/cms/src/post.php?id={$row['id']}">{$row['title']}</a>
                </h2>
                <p class="lead">
                    by <a href="index.php">{$row['author']}</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on {$row['date']}</p>
                <hr>
                <img class="img-responsive" src="/{$row['image']}" alt="">
                <hr>
                <p>{$content}</p>
                <a class="btn btn-primary" href="/cms/src/post.php?id={$row['id']}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
EOT;
                echo $html;
            }
            ?>

            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/cms/src/sidebar.php' ?>
    </div>
    <!-- /.row -->
    <hr>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/cms/src/footer.php'; ?>