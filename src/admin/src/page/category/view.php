<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/src/model/category.php';

class CategoryViewer
{
    public static function viewInSelect()
    {
        $result = Category::readAll();
        $el = "<select name='category' id='category'>";
        while ($row = $result->fetch_assoc()) {
            $html = "<option value='{$row['id']}'>{$row['title']}</option>";
            $el .= $html;
        }

        $el .= "</select>";

        return $el;
    }
}