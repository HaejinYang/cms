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
                        유저 수정
                    </h1>
                    <?php
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/model/UserStore.php';
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/view/UserViewer.php';
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/util/response.php';
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/util/response.php';

                    $response_msg = "";
                    $is_success = false;
                    do {
                        if (!isset($_SESSION['user_account'])) {
                            $response_msg = "잘못된 요청입니다.";

                            break;
                        }

                        try {
                            $user_dao = new UserStore();
                            $user = null;
                            $account = $_SESSION['user_account'];
                            $result = $user_dao->readByAccount($user, $account);
                            if ($result !== UserStore::ERROR_OK) {
                                $response_msg = UserStore::getErrorCodeToMsg($result);

                                break;
                            }

                            $select_role = UserViewer::selectWithOptions($user['role']);
                            $el = <<<EOT
                    <form action="/api/user/edit.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Id</label>
                            <input type="text" class="form-control" name="id" value="{$user['id']}" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label for="title">계정</label>
                            <input type="text" class="form-control" name="account" value="{$user['account']}">
                        </div>

                        <div class="form-group">
                            <label for="title">비밀번호</label>
                            <input type="password" class="form-control" name="password">
                        </div>

                        <div class="form-group">
                            <label for="title">비밀번호확인</label>
                            <input type="password" class="form-control" name="password_check">
                        </div>

                        <div class="form-group">
                            <label for="title">성</label>
                            <input type="text" class="form-control" name="lastname" value="{$user['lastname']}">
                        </div>

                        <div class="form-group">
                            <label for="title">이름</label>
                            <input type="text" class="form-control" name="firstname" value="{$user['firstname']}">
                        </div>

                        <div class="form-group">
                            <label for="title">Email</label>
                            <input type="email" class="form-control" name="email" value="{$user['email']}">
                        </div>

                        <div class="form-group">
                            <div>
                                <label for="title">역할</label>
                            </div>
                            {$select_role}
                        </div>

                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="edit" value="추가">
                        </div>
                    </form>
EOT;
                            $is_success = true;
                            echo $el;
                        } catch (mysqli_sql_exception $e) {
                            $response_msg = $e->getMessage();
                        }
                    } while (false);

                    if (!$is_success) {
                        echo goBackWithAlert($response_msg);
                    }
                    ?>
                </div>
            </div>
            <!-- /.row -->


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/layout/footer.php' ?>
