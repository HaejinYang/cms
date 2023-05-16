<!-- header -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/cms/layout/header.php'; ?>

<!-- Navigation -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/cms/layout/navigation.php'; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <!-- Blog Post -->
            <?php
            require_once $_SERVER['DOCUMENT_ROOT'] . '/model/post.php';
            if (isset($_GET['post_id'])) {
                $id = $_GET['post_id'];
                $post = new Post();
                $row = $post->read($id);
                $content = $row['content'];
                $html = <<<EOT
                        <h1>{$row['title']}</h1>
                        <p class="lead">
                            by {$row['author']}
                        </p>
                        
                        <hr>
                        
                        <p><span class="glyphicon glyphicon-time"></span> Posted on {$row['date']}</p>
                        
                        <hr>
                        
                        <img class="img-responsive" src="/{$row['image']}" alt="">
                        
                        <hr>
                        
                        <p>{$content}</p>
            
                        <hr>
EOT;
                echo $html;
            }
            ?>

            <?php
            require_once $_SERVER['DOCUMENT_ROOT'] . '/model/post.php';
            if (isset($_GET['category_id'])) {
                $id = $_GET['category_id'];
                $post = new Post();
                $post->readByCategoryId($id);
                $el = "";
                while ($row = $post->next()) {
                    $html = <<<EOT
                        <h1>{$row['title']}</h1>
                        <p class="lead">
                            by {$row['author']}
                        </p>
                        
                        <hr>
                        
                        <p><span class="glyphicon glyphicon-time"></span> Posted on {$row['date']}</p>
                        
                        <hr>
                        
                        <img class="img-responsive" src="/{$row['image']}" alt="">
                        
                        <hr>
                        
                        <p>{$content}</p>
            
                        <hr>
EOT;
                }

                echo $html;
            }
            ?>
            <!-- Posted Comments -->

            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.
                    Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
                    vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
            </div>

            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.
                    Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
                    vulputate fringilla. Donec lacinia congue felis in faucibus.
                    <!-- Nested Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Nested Start Bootstrap
                                <small>August 25, 2014 at 9:30 PM</small>
                            </h4>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin
                            commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce
                            condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                    </div>
                    <!-- End Nested Comment -->
                </div>
            </div>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/cms/layout/sidebar.php' ?>
    </div>
    <!-- /.row -->
    <hr>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/cms/layout/footer.php'; ?>