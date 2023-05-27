<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/model/PostStore.php';

if (isset($_POST['create'])) {
    $post = new PostStore();
    $date = date('y-m-d');
    $comment_count = 0;
    $post->create($_POST['title'], $_POST['category_id'], $_POST['author'], $_POST['status'], $_POST['tags'], $_POST['content'],
        $_FILES['image']['name'], $_FILES['image']['tmp_name'], $date, $comment_count);


}
?>

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
                        게시글 추가
                    </h1>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">제목</label>
                            <input type="text" class="form-control" name="title">
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="category_id">카테고리</label>
                            </div>
                            <?php
                            require_once $_SERVER['DOCUMENT_ROOT'] . '/view/CategoryViewer.php';
                            echo CategoryViewer::viewInSelect(-1);
                            ?>
                        </div>

                        <div class="form-group">
                            <label for="author">작성자</label>
                            <input type="text" class="form-control" name="author">
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="status">상태</label>
                            </div>
                            <select name="status">
                                <?php
                                require_once $_SERVER['DOCUMENT_ROOT'] . '/model/PostStore.php';

                                $status_arr = PostStore::getStatus();
                                $el = "";
                                foreach ($status_arr as $key => $value) {
                                    $html = "<option value='{$key}'>{$value}</option>";
                                    $el .= $html;
                                }
                                echo $el;
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image">대표 이미지</label>
                            <input type="file" class="form-control" name="image">
                        </div>

                        <div class="form-group">
                            <label for="tags">태그</label>
                            <input type="text" class="form-control" name="tags">
                        </div>

                        <div class="form-group">
                            <label for="content">내용</label>
                            <textarea id="summernote" class="form-control" name="content" id="" cols="30"
                                      rows="10"></textarea>
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
