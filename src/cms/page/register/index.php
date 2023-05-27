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
                        <form role="form" action="/api/auth/register.php" method="post" id="login-form"
                              autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">아이디</label>
                                <input type="text" name="username" id="username" class="form-control"
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