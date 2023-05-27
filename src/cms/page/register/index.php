<!-- header -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/cms/layout/header.php'; ?>

<!-- Navigation -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/cms/layout/navigation.php'; ?>

<!-- Page Content -->
<div class="container">
    <!-- 가입 -->
    <section id="login">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>회원가입</h1>
                        <?php
                        if (isset($_SESSION['API_RESPONSE_RESULT'])) {
                            $msg = $_SESSION['API_RESPONSE_MSG'];
                            $is_api_success = $_SESSION['API_RESPONSE_RESULT'];
                            unset($_SESSION['API_RESPONSE_MSG']);
                            unset($_SESSION['API_RESPONSE_RESULT']);
                            if ($is_api_success) {
                                echo "<p class='bg-success'>{$msg}</p>";
                            } else {
                                echo "<p class='bg-danger'>{$msg}</p>";
                            }
                        }
                        ?>
                        <form role="form" action="/api/auth/register.php" method="post" id="login-form"
                              autocomplete="off">
                            <div class="form-group">
                                <label for="account" class="sr-only">아이디</label>
                                <input type="text" name="account" id="username" class="form-control"
                                       placeholder="아이디">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                       placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">비밀번호</label>
                                <input type="password" name="password" id="key" class="form-control"
                                       placeholder="비밀번호">
                            </div>

                            <div class="form-group">
                                <label for="password" class="sr-only">비밀번호확인</label>
                                <input type="password" name="password_check" id="key" class="form-control"
                                       placeholder="비밀번호확인">
                            </div>

                            <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block"
                                   value="등록하기">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>
    <hr>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/cms/layout/footer.php'; ?>