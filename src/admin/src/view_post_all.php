<table class="table table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>글쓴이</th>
        <th>제목</th>
        <th>카테고리</th>
        <th>상태</th>
        <th>이미지</th>
        <th>태그</th>
        <th>댓글</th>
        <th>날짜</th>
    </tr>
    </thead>
    <tbody>
    <?php
    require_once __DIR__ . '/model/post.php';

    $post = new Post();
    $post->readAll();
    $el = "";
    while ($row = $post->next()) {
        $html = "
                                <tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['author']}</td>
                                    <td>{$row['title']}</td>
                                    <td>{$row['category_id']}</td>
                                    <td>{$row['status']}</td>
                                    <td><img style='max-width: 100px;' src='/{$row['image']}' class='img-responsive' alt='image'></td>
                                    <td>{$row['tags']}</td>
                                    <td>{$row['comment_count']}</td>
                                    <td>{$row['date']}</td>
                                </tr>
                                ";

        $el .= $html;
    }

    echo $el;
    ?>
    </tbody>
</table>