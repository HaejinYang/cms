<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/layout/header.php' ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/layout/navigation.php' ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        유저 추가
                    </h1>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">닉네임</label>
                            <input type="text" class="form-control" name="nickname">
                        </div>

                        <div class="form-group">
                            <label for="title">성</label>
                            <input type="text" class="form-control" name="lastname">
                        </div>

                        <div class="form-group">
                            <label for="title">이름</label>
                            <input type="text" class="form-control" name="firstname">
                        </div>

                        <div class="form-group">
                            <label for="title">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="title">역할</label>
                            </div>
                            <select name="role">
                                <?php
                                require_once $_SERVER['DOCUMENT_ROOT'] . '/model/user.php';
                                $roles = User::getAllRole();
                                $el = "";
                                foreach ($roles as $key => $value) {
                                    $html = "<option value='{$key}]'>{$value}</option>";
                                    $el .= $html;
                                }
                                echo $el;
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="create" value="저장">
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/layout/footer.php' ?>
