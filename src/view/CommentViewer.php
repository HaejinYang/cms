<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/CommentStore.php';

class CommentViewer
{
    private $dao;

    public function __construct()
    {
        $this->dao = new CommentStore();
    }

    public function allCommentsInPost(int $post_id)
    {
        try {
            $rows = $this->dao->readByPostId($post_id);
            $el = "";
            foreach ($rows as $row) {
                if ($row['status'] !== 'approve') {
                    continue;
                }

                $html = <<<EOT
                    <!-- CommentStore -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{$row['author']}
                                <small>{$row['date']}</small>
                            </h4>
                            {$row['content']}
                        </div>
                    </div>
EOT;
                $el .= $html;
            }

            return $el;
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }

    public function submitFormInPost(int $post_id)
    {
        $html = <<<EOT
        <div class="well">
                <h4>댓글 남기기:</h4>
                <form action="/cms/api/comment/create.php" method="post" role="form">
                    <div class="form-group">
                        <label for="author">작성자</label>
                        <input type="text" name="author" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="comment">댓글</label>
                        <textarea class="form-control" rows="3" name="content"></textarea>
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="post_id" value="{$post_id}">
                    </div>

                    <button type="submit" name="create" class="btn btn-primary">작성</button>
                </form>
            </div>
EOT;
        return $html;
    }
}