<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/admin/index.php">CMS Admin</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li><a href="/cms/index.php">HOME SITE</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                <?php
                if (isset($_SESSION['user_account'])) {
                    echo $_SESSION['user_account'];
                }
                ?>
                <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="/api/auth/logout.php"><i class="fa fa-fw fa-power-off"></i>로그아웃</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="active">
                <a href="/admin/index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i
                        class="fa fa-fw fa-arrows-v"></i>
                    게시글 <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="posts_dropdown" class="collapse">
                    <li>
                        <a href="/admin/page/post/index.php"> 모든 게시글 보기</a>
                    </li>
                    <li>
                        <a href="/admin/page/post/add.php"> 게시글 추가</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="/admin/page/category/index.php"><i class="fa fa-fw fa-wrench"></i> 카테고리</a>
            </li>
            <li>
                <a href="/admin/page/comment/index.php"><i class="fa fa-fw fa-file"></i> 댓글</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#user_dropdown"><i
                        class="fa fa-fw fa-arrows-v"></i>
                    유저 <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="user_dropdown" class="collapse">
                    <li>
                        <a href="/admin/page/user/index.php">모든 유저 보기</a>
                    </li>
                    <li>
                        <a href="/admin/page/user/add.php">유저 추가</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="/admin/page/profile/index.php"><i class="fa fa-fw fa-dashboard"></i>프로필</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>