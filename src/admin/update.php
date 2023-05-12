<?php
require_once '../db/db.php';

// update category
if (isset($_POST['update']) && isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $title = $_POST['title'];

    if (!(empty($id) || empty($title))) {
        $query = "UPDATE category SET title=? WHERE id=?";
        $stmt = DB::prepare($query);
        $stmt->bind_param("si", $title, $id);
        $stmt->execute();

        header("Location: category.php");
    }
}
