<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/cms/index.php">Home</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                require_once $_SERVER['DOCUMENT_ROOT'] . '/view/CategoryViewer.php';

                echo CategoryViewer::viewInList(5);

                ?>
                <li><a href="/admin">관리자</a></li>
                <?php
                require_once $_SERVER['DOCUMENT_ROOT'] . '/service/UserManager.php';
                $user_manager = new UserManager();
                if ($user_manager->isAdmin() && isset($_GET['id'])) {
                    echo "<li><a href='/admin/page/post/edit.php?id={$_GET['id']}'>게시글 수정</a></li>";
                }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>