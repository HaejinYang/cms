<?php
require_once __DIR__ . '/header.php' ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php require_once __DIR__ . '/navigation.php' ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small>Subheading</small>
                    </h1>

                    <?php
                    if (isset($_GET['id'])) {
                        require_once __DIR__ . '/add_post.php';
                        //require_once __DIR__ . '/view_post.php';
                    } else {
                        require_once __DIR__ . '/view_post_all.php';
                    }
                    ?>
                </div>
            </div>
            <!-- /.row -->


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php require_once __DIR__ . '/footer.php' ?>
