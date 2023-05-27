<?php

function goBackWithAlert($msg): string
{
    $response = "
    <script>
    alert('{$msg}');
    history.back();
    </script>
    ";

    return $response;
}

function goBackWithSession(array $sessions): string
{
    foreach ($sessions as $key => $val) {
        $_SESSION[$key] = $val;
    }

    $response = "
    <script>
    history.back();
    </script>
    ";

    return $response;
}