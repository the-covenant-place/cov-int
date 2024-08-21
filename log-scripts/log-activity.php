<?php
function logActivity($user_id, $action, $details = null) {

    $logFile = __DIR__ . '/../logs/activity.log';
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    $logEntry = sprintf(
        "[%s] User ID: %d - Action: %s - Details: %s - IP: %s\n",
        date("Y-m-d H:i:s"),
        $user_id,
        $action,
        $details ?? 'N/A',
        $ipAddress
    );

    file_put_contents($logFile, $logEntry, FILE_APPEND);

}