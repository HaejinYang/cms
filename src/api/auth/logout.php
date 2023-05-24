<?php
session_start();

unset($_SESSION['user_account']);
unset($_SESSION['user_lastname']);
unset($_SESSION['user_firstname']);
unset($_SESSION['user_role']);

header("Location: /cms/index.php");