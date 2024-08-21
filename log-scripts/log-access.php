<?php

$logFile = __DIR__ .'/../logs/access.log';

$logEntry = sprintf(
    "[%s] %s %s %s %s\n",
    date('Y-m-d H:i:s'),
    $_SERVER['REMOTE_ADDR'],
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI'],
    http_response_code()
);

file_put_contents($logFile, $logEntry, FILE_APPEND);

