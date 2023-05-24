<div class="col-md-4">
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
            </div>
        </form> <!-- search form -->
        <!-- /.input-group -->
    </div>

    <!-- 로그인 -->
    <div class="well">
        <h4>로그인</h4>
        <form action="/api/auth/login.php" method="post">
            <div class="form-group">
                <input name="account" type="text" class="form-control" placeholder="아이디">
            </div>
            <div class="input-group">
                <input name="password" type="password" class="form-control" placeholder="비밀번호">
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">로그인</button>
                </span>
            </div>
        </form> <!-- 로그인 폼 -->
        <?php
        ?>
    </div> <!-- 로그인 -->

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/view/CategoryViewer.php';

                    echo CategoryViewer::viewInList(3);

                    ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus
            laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>