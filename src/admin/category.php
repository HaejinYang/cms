<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/header.php' ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/navigation.php' ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small>Subheading</small>
                    </h1>
                    <div class="col-xs-6">
                        <?php
                        require_once "../db/db.php";
                        if (isset($_POST['add'])) {
                            $title = $_POST['title'];

                            if (empty($title)) {
                                echo "빈 칸을 채워주세요";
                            } else {
                                $query = "INSERT INTO category(title) VALUES(?)";
                                $stmt = DB::prepare($query);
                                $stmt->bind_param("s", $title);
                                $result = $stmt->execute();
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
                        require_once '../db/db.php';

                        // update category
                        require_once './update.php';
                        
                        // edit cateogry
                        if (isset($_GET['edit'])) {
                            $id = $_GET['edit'];
                            $query = "SELECT * FROM category WHERE id = ?";
                            $stmt = DB::prepare($query);
                            $stmt->bind_param("i", $id);
                            if ($stmt->execute()) {
                                $result = $stmt->get_result();
                                $row = $result->fetch_assoc();
                                $title = $row['title'];
                            }
                        }
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="title">카테고리 수정</label>
                                <?php
                                if (isset($title)) {
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
                        <table class="table table-bordered table-hover">
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
                            require_once '../db/db.php';

                            // delete category
                            if (isset($_GET['delete'])) {
                                $id = $_GET['delete'];
                                $query = "DELETE FROM category WHERE id = ?";
                                $stmt = DB::prepare($query);
                                $stmt->bind_param("i", $id);
                                $stmt->execute();
                                header("Location: category.php");
                            }

                            // find all category
                            $result = DB::query("SELECT * FROM category");
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
                                    <a href='category.php?delete={$row['id']}'>삭제</a>
                                    </td>
                                    <td>
                                    <a href='category.php?edit={$row['id']}'>수정</a>
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

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/footer.php' ?>
