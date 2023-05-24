<?php require_once __DIR__ . '/layout/header.php' ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php require_once __DIR__ . '/layout/navigation.php' ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small>
                            <?php
                            $h = "{$_SESSION['user_account']}";
                            echo $h;
                            ?>
                        </small>
                    </h1>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php require_once __DIR__ . '/layout/footer.php' ?>
