<?php
if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category_id = $_POST['category_id'];
    $status = $_POST['status'];
    $tags = $_POST['tags'];
    $content = $_POST['content'];
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $date = date('d-m-y');
    $comment_count = 0;

    move_uploaded_file($image_temp, $_SERVER['DOCUMENT_ROOT'] . '/images/' . $image);
    echo $image;
    echo "</br>";
    echo $image_temp;
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">게시글 제목</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="category_id">카테고리 Id</label>
        <input type="text" class="form-control" name="category_id">
    </div>

    <div class="form-group">
        <label for="author">작성자</label>
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="status">상태</label>
        <input type="text" class="form-control" name="status">
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
        <textarea class="form-control" name="content" id="" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create" value="게시글 저장">
    </div>
</form>