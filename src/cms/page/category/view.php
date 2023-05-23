<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/model/Category.php';

class CategoryViewer
{
    public static function viewInList(int $limit = -1)
    {
        $result = Category::readLimit($limit);
        $el = '';
        while ($row = $result->fetch_assoc()) {
            $li = "<li><a href='/cms/index.php?category_id={$row['id']}'>{$row['title']}</a></li>";
            $el .= $li;
        }

        return $el;
    }
}