<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/db/db.php');

$result = DB::query("SELECT * FROM category");

$body = "";

while ($row = $result->fetch_assoc()) {
    $str = "<div> {$row['title']}</div>";
    $body .= $str;
}

echo $body;