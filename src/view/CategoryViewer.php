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
}