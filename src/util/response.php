<?php

function goBackWithResponse($msg): string
{
    $response = "
    <script>
    alert('{$msg}');
    history.back();
    </script>
    ";

    return $response;
}