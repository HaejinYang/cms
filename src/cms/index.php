<!-- header -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/cms/layout/header.php'; ?>

<!-- Navigation -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/cms/layout/navigation.php'; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header">
                게시글
            </h1>

            <!-- First Blog Post -->
            <?php
            $post_list = require_once $_SERVER['DOCUMENT_ROOT'] . '/cms/page/post/list.php';
            echo $post_list;
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
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/cms/layout/sidebar.php' ?>
    </div>
    <!-- /.row -->
    <hr>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/cms/layout/footer.php'; ?>