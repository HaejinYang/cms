<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/db/db.php');

$result = DB::query("SELECT * FROM category");

while ($row = $result->fetch_assoc()) {
    echo $row['title'].'</br>';
}