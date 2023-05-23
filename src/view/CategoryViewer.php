<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/model/Category.php';

class CategoryViewer
{
    public static function viewInSelect(int $focus_id)
    {
        $result = Category::readAll();
        $el = "<select name='category_id' id='category_id'>";
        while ($row = $result->fetch_assoc()) {
            $html = "<option value={$row['id']}";
            if ($row['id'] == $focus_id) {
                $html .= " selected";
            }
            $html .= ">{$row['title']}</option>";
            $el .= $html;
        }

        $el .= "</select>";

        return $el;
    }

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