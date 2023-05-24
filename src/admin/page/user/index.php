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
                        유저
                    </h1>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>계정</th>
                            <th>성</th>
                            <th>이름</th>
                            <th>Email</th>
                            <th>역할</th>
                            <th>날짜</th>
                            <th colspan="3">관리</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        require_once $_SERVER['DOCUMENT_ROOT'] . '/model/UserStore.php';

                        try {
                            $user_dao = new UserStore();
                            $rows = $user_dao->readAll();
                            $el = "";
                            foreach ($rows as $row) {
                                $html = "<tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['account']}</td>
                                        <td>{$row['lastname']}</td>
                                        <td>{$row['firstname']}</td>
                                        <td>{$row['email']}</td>
                                        <td>{$row['role']}</td>
                                        <td>{$row['date']}</td>
                                        <td><a href='/admin/api/user/role.php?id={$row['id']}&role=admin'>관리자</a></td>
                                        <td><a href='/admin/api/user/role.php?id={$row['id']}&role=subscriber'>구독자</a></td>
                                        <td><a href='/admin/page/user/edit.php?id={$row['id']}'>수정</a></td>
                                        <td><a href='/admin/api/user/delete.php?id={$row['id']}'>삭제</a></td>
                                    </tr>";
                                $el .= $html;
                            }

                            echo $el;
                        } catch (mysqli_sql_exception $e) {
                            echo $e->getMessage();
                        }
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


