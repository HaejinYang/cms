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