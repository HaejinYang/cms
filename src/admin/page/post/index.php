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
                        게시글
                    </h1>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>글쓴이</th>
                            <th>제목</th>
                            <th>카테고리</th>
                            <th>상태</th>
                            <th>이미지</th>
                            <th>태그</th>
                            <th>댓글</th>
                            <th>날짜</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        require_once $_SERVER['DOCUMENT_ROOT'] . '/model/Post.php';
                        require_once $_SERVER['DOCUMENT_ROOT'] . '/model/Category.php';
                        $post = new Post();
                        $post->readAll();
                        $el = "";
                        while ($row = $post->next()) {
                            $category_title = Category::read($row['category_id']);

                            $html = "<tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['author']}</td>
                                        <td>{$row['title']}</td>
                                        <td>{$category_title}</td>
                                        <td>{$row['status']}</td>
                                        <td><img style='max-width: 100px;' src='/{$row['image']}' class='img-responsive' alt='image'></td>
                                        <td>{$row['tags']}</td>
                                        <td>{$row['comment_count']}</td>
                                        <td>{$row['date']}</td>
                                        <td><a href='/admin/page/post/delete.php?id={$row['id']}'>삭제</a></td>
                                        <td><a href='/admin/page/post/edit.php?id={$row['id']}'>수정</a></td>
                                    </tr>";
                            $el .= $html;
                        }

                        echo $el;
                        ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- /.row -->


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/layout/footer.php' ?>


