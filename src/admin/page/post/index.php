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
                    <form method='post' action="/api/post/edit.php">
                        <table class="table table-hover">
                            <div id="bulk_option_container" class="col-xs-4" style="padding: 0px;">
                                <select class="form-control" name="bulk_option">
                                    <option value="not_selected">Select Options</option>
                                    <option value="published">공개</option>
                                    <option value="draft">보류</option>
                                    <option value="delete">삭제</option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <input type="submit" name="request" class="btn btn-success" value="적용">
                            </div>
                            <thead>
                            <tr>
                                <th><input id="select_all_boxes" type="checkbox"</th>
                                <th>Id</th>
                                <th>글쓴이</th>
                                <th>제목</th>
                                <th>카테고리</th>
                                <th>상태</th>
                                <th>이미지</th>
                                <th>태그</th>
                                <th>댓글</th>
                                <th>날짜</th>
                                <th>조회수</th>
                                <th colspan="3">관리</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            require_once $_SERVER['DOCUMENT_ROOT'] . '/model/PostStore.php';
                            require_once $_SERVER['DOCUMENT_ROOT'] . '/model/CategoryStore.php';
                            $post = new PostStore();
                            $rows = $post->readAll(999);
                            $el = "";
                            foreach ($rows as $row) {
                                $category_title = CategoryStore::read($row['category_id']);

                                $html = "<tr>
                                        <th><input class='check_boxes' type='checkbox' name='check_box_array[]' value='{$row['id']}'></th>
                                        <td>{$row['id']}</td>
                                        <td>{$row['author']}</td>
                                        <td>{$row['title']}</td>
                                        <td>{$category_title}</td>
                                        <td>{$row['status']}</td>
                                        <td><img style='max-width: 100px;' src='/{$row['image']}' class='img-responsive' alt='image'></td>
                                        <td>{$row['tags']}</td>
                                        <td>{$row['comment_count']}</td>
                                        <td>{$row['date']}</td>
                                        <td>{$row['views']}</td>
                                        <td><a href='/cms/page/post/index.php?id={$row['id']}'>보기</a></td>
                                        <td><a href='/admin/page/post/edit.php?id={$row['id']}'>수정</a></td>
                                        <td><a href='/api/post/delete.php?id={$row['id']}'>삭제</a></td>
                                    </tr>";
                                $el .= $html;
                            }

                            echo $el;
                            ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <!-- /.row -->


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/layout/footer.php' ?>


