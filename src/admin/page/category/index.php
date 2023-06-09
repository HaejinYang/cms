<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/layout/header.php'; ?>
<div id="wrapper">

    <!-- Navigation -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/layout/navigation.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        카테고리
                    </h1>
                    <div class="col-xs-6">
                        <?php
                        require_once $_SERVER['DOCUMENT_ROOT'] . '/model/CategoryStore.php';

                        if (isset($_POST['add'])) {
                            $title = $_POST['title'];

                            if (empty($title)) {
                                echo "빈 칸을 채워주세요";
                            } else {
                                CategoryStore::create($title);
                            }
                        }
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="title">카테고리 추가</label>
                                <input class="form-control" type="text" name="title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="add" value="카테고리 추가">
                            </div>
                        </form>
                        <?php
                        // update category
                        require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/page/category/update.php';
                        require_once $_SERVER['DOCUMENT_ROOT'] . '/model/CategoryStore.php';

                        // edit cateogry
                        if (isset($_GET['edit'])) {
                            $id = $_GET['edit'];
                            $title = CategoryStore::read($id);
                        }
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="title">카테고리 수정</label>
                                <?php
                                if (isset($title) && isset($_GET['edit'])) {
                                    echo "<input class='form-control' type='text' name='title' value={$title}>";
                                }
                                ?>
                            </div>
                            <div class=" form-group">
                                <input class="btn btn-primary" type="submit" name="update" value="카테고리 업데이트">
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-6">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>
                                    Id
                                </th>
                                <th>
                                    카테고리
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            require_once $_SERVER['DOCUMENT_ROOT'] . '/model/CategoryStore.php';

                            // delete category
                            if (isset($_GET['delete'])) {
                                $id = $_GET['delete'];
                                CategoryStore::delete($id);
                                header("Location: index.php");
                            }

                            // find all category
                            $result = CategoryStore::readAll();
                            $el = "";
                            while ($row = $result->fetch_assoc()) {
                                $html = "
                                    <tr>
                                    <td>
                                    {$row['id']}
                                    </td>
                                    <td>
                                    {$row['title']}
                                    </td>
                                    <td>
                                    <a href='index.php?delete={$row['id']}'>삭제</a>
                                    </td>
                                    <td>
                                    <a href='index.php?edit={$row['id']}'>수정</a>
                                    </td>
                                    </tr>
                                    ";
                                $el .= $html;
                            }

                            echo $el;
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/layout/footer.php' ?>
