<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <div class="input-group">
            <input type="text" class="form-control">
            <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
        </div>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php
                    require_once $_SERVER['DOCUMENT_ROOT'].'/db/db.php';
                    $result = DB::query("SELECT * FROM category");

                    $el = '';
                    while($row = $result->fetch_assoc()) {
                        $li = "<li><a href=\"#\">{$row['title']}</a></li>";
                        $el .= $li;
                    }

                    echo $el;
                    ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
            <!--                        <div class="col-lg-6">-->
            <!--                            <ul class="list-unstyled">-->
            <!--                                <li><a href="#">Category Name</a>-->
            <!--                                </li>-->
            <!--                                <li><a href="#">Category Name</a>-->
            <!--                                </li>-->
            <!--                                <li><a href="#">Category Name</a>-->
            <!--                                </li>-->
            <!--                                <li><a href="#">Category Name</a>-->
            <!--                                </li>-->
            <!--                            </ul>-->
            <!--                        </div>-->
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>