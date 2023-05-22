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
                        Welcome to admin
                        <small>Subheading</small>
                    </h1>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>글쓴이</th>
                            <th>내용</th>
                            <th>Email</th>
                            <th>상태</th>
                            <th>게시글</th>
                            <th>날짜</th>
                            <th class="text-center" colspan="4">관리</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        require_once $_SERVER['DOCUMENT_ROOT'] . '/model/comment.php';
                        require_once $_SERVER['DOCUMENT_ROOT'] . '/model/post.php';
                        $comment = new Comment();
                        $rows = $comment->readAll();
                        $el = "";

                        $post = new Post();

                        foreach ($rows as $row) {
                            $post_id = $row['post_id'];
                            $post_row = $post->read($post_id);

                            $post_title = $post_row['title'];
                            $html = "<tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['author']}</td>
                                        <td>{$row['content']}</td>
                                        <td>{$row['email']}</td>
                                        <td>{$row['status']}</td>
                                        <td><a href='/cms/page/post/index.php?id={$post_id}'>{$post_row['title']}</a></td>
                                        <td>{$row['date']}</td>
                                        <td><a href='/admin/api/comment/approve.php?id={$row['id']}'>승인</a></td>
                                        <td><a href='/admin/api/comment/unapprove.php?id={$row['id']}'>거부</a></td>
                                        <td><a href='/admin/api/comment/edit.php?id={$row['id']}'>수정</a></td>
                                        <td><a href='/admin/api/comment/delete.php?id={$row['id']}'>삭제</a></td>
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


