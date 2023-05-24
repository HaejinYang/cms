<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/model/PostStore.php';

if (isset($_POST['edit'])) {
    $post = new PostStore();

    $image_temp_path = "";
    $image = "";
    if ($_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $image_temp_path = $_FILES['image']['tmp_name'];
        $post->updateWithImage($_POST['id'], $_POST['title'], $_POST['category_id'], $_POST['author'], $_POST['status'], $_POST['tags'],
            $_POST['content'], $image, $image_temp_path, date('y-m-d'), $_POST['comment_count']);
    } else {
        $post->update($_POST['id'], $_POST['title'], $_POST['category_id'], $_POST['author'], $_POST['status'], $_POST['tags'],
            $_POST['content'], date('y-m-d'), $_POST['comment_count']);
    }

    header("Location: /admin/page/post/index.php");

    return;
}

if (!isset($_GET['id'])) {
    header("Location: /admin/page/post/index.php");

    return;
}

$id = $_GET['id'];
$post = new PostStore();
$row = $post->read($id);
if ($row === null) {
    header("Location: /admin/page/post/index.php");
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
                            <label for="title">Id</label>
                            <input type="text" class="form-control" name="id" value="<?php echo $row['id'] ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="title">제목</label>
                            <input type="text" class="form-control" name="title" value="<?php echo $row['title'] ?>">
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="category_id">카테고리</label>
                            </div>
                            <?php
                            require_once $_SERVER['DOCUMENT_ROOT'] . '/view/CategoryViewer.php';
                            echo CategoryViewer::viewInSelect($row['category_id']);
                            ?>
                        </div>

                        <div class="form-group">
                            <label for="author">작성자</label>
                            <input type="text" class="form-control" name="author" value="<?php echo $row['author'] ?>">
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="status">상태</label>
                            </div>
                            <select name="status">
                                <?php
                                require_once $_SERVER['DOCUMENT_ROOT'] . '/model/PostStore.php';
                                $status = $row['status'];
                                $status_arr = PostStore::getStatus();
                                $options = ["draft" => "<option value='draft' ", "publish" => "<option value='publish'"];
                                $html = "";
                                foreach ($options as $key => $el) {
                                    if ($key === $status) {
                                        $el .= " selected>{$status_arr[$key]}</option>";
                                    } else {
                                        $el .= ">{$status_arr[$key]}</option>";
                                    }
                                    $html .= $el;
                                }
                                echo $html;
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="image">이전 이미지</label>
                            </div>
                            <img style="max-width: 100px;" src="/<?php echo $row['image']; ?>">
                            <!--                            -->
                            <!--                            <input type="file" class="form-control" name="image" value="-->
                            <?php //echo $row['image'] ?><!--">-->
                        </div>

                        <div class="form-group">
                            <label for="image">변경 이미지</label>
                            <input type="file" class="form-control" name="image">
                        </div>

                        <div class="form-group">
                            <label for="tags">태그</label>
                            <input type="text" class="form-control" name="tags" value="<?php echo $row['tags'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="content">내용</label>
                            <textarea class="form-control" name="content" id="" cols="30"
                                      rows="10"><?php echo $row['content'] ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="title">댓글 갯수</label>
                            <input type="text" class="form-control" name="comment_count"
                                   value="<?php echo $row['comment_count'] ?>" readonly>
                        </div>

                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="edit" value="수정">
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
