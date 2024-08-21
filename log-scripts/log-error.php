<?php

ini_set("display_errors", 0);
ini_set("log_erroes",1);
ini_set("error_log", __DIR__ .'/../logs/error.log');
error_reporting(E_ALL);

$logFile = __DIR__ .'/../logs/error.log';

if (isset($GLOBALS['php_errormsg']) || ($errors = error_get_last())) {
    $logEntry = sprintf(
        "[%s] %s: %s in %s on line %d\n",
        date("Y-m-d H:i:s"),
        $errors['type'] ?? 'Unknown Error',
        $errors['message'] ?? 'No message',
        $errors['file'] ?? 'No file',
        $errors['line'] ?? 'No line'
    );

    file_put_contents($logFile, $logEntry, FILE_APPEND);
}