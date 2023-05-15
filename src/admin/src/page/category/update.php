<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/model/category.php';

// update category
if (isset($_POST['update']) && isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $title = $_POST['title'];

    if (!(empty($id) || empty($title))) {
        Category::update($id, $title);

        header("Location: index.php");
    }
}
