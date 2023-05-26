<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/PostStore.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/CommentStore.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/UserStore.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/CategoryStore.php';
$category_count = CategoryStore::countAllCategories();
$user_store = new UserStore();
$user_count = $user_store->countAllUsers();
$user_sub_count = $user_store->countAllSubscribers();
$user_admin_count = $user_store->countAllAdmins();
$post_store = new PostStore();
$post_count = $post_store->countAllPosts();
$post_draft_count = $post_store->countAllDraft();
$post_publish_count = $post_store->countAllPublish();
$comment_store = new CommentStore();
$comment_count = $comment_store->countAllComments();
$comment_approved_count = $comment_store->countAllApproved();
$comment_unapproved_count = $comment_store->countAllUnapproved();


$html = <<<EOT
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'>
                            {$post_count}
                        </div>
                        <div>게시글</div>
                    </div>
                </div>
            </div>
            <a href="/admin/page/post/index.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'>
                            {$comment_count}
                        </div>
                        <div>댓글</div>
                    </div>
                </div>
            </div>
            <a href="/admin/page/comment/index.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'>
                            {$user_count}
                        </div>
                        <div>유저</div>
                    </div>
                </div>
            </div>
            <a href="/admin/page/user/index.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'>
                            {$category_count}
                        </div>
                        <div>카테고리</div>
                    </div>
                </div>
            </div>
            <a href="/admin/page/category/index.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div id="columnchart_material" style="width: auto; height: 500px;"></div>

    <script type="text/javascript">
        google.charts.load('current', {'packages': ['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['통계', '합계'],
                ['공개 게시글', {$post_publish_count}],
                ['비공개 게시글', {$post_draft_count}],
                ['승인 댓글', {$comment_approved_count}],
                ['미승인 댓글', {$comment_unapproved_count}],
                ['관리자', {$user_admin_count}],
                ['구독자', {$user_sub_count}],
                ['카테고리', {$category_count}],
            ]);

            var options = {
                chart: {
                    title: 'Company Performance',
                    subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
</div>
EOT;

echo $html;
