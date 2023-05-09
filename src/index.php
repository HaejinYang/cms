<!-- header -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>

<!-- Navigation -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/navigation.php'; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <?php require_once $_SERVER['DOCUMENT_ROOT'].'/post.php' ?>

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
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/sidebar.php' ?>
        </div>
        <!-- /.row -->
        <hr>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>