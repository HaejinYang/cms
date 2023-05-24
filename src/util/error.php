<?php

namespace util\error;

function shutdownFunction(): void
{
    $err = \error_get_last();

    if (!isset($err)) {
        return;
    }

    $handledErrorTypes = array(
        E_USER_ERROR => 'USER ERROR',
        E_ERROR => 'ERROR',
        E_PARSE => 'PARSE',
        E_CORE_ERROR => 'CORE_ERROR',
        E_CORE_WARNING => 'CORE_WARNING',
        E_COMPILE_ERROR => 'COMPILE_ERROR',
        E_COMPILE_WARNING => 'COMPILE_WARNING');

    // If our last error wasn't fatal then this must be a normal shutdown.
    if (!isset($handledErrorTypes[$err['type']])) {
        return;
    }

    if (!headers_sent()) {
        header('HTTP/1.1 500 Internal Server Error');
    }

    // Perform simple logging here.
}

function exceptionHandler($e): void
{
    $msg = $e->getMessage();
    $code = $e->getCode();
    $file = $e->getFile();
    $line = $e->getLine();
    $trace = $e->getTraceAsString();
    $print = "[{$msg}][{$code}]:[{$file}:{$line}][trace: {$trace}]";

    echo $print;
}

function errorHandler($errno, $errstr, $errfile, $errline): bool
{
    throw new \ErrorException($errstr, $errno, 0, $errfile, $errline);
}

set_exception_handler('util\error\exceptionHandler');
set_error_handler('util\error\errorHandler', E_ALL);
register_shutdown_function('util\error\shutdownFunction');