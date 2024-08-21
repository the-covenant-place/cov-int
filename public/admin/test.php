<?php

session_start();

//Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../public/admin/login.html');
    exit();
}else {
    $username = htmlspecialchars($_SESSION['username']);
}

$user_id = $_SESSION['user_id'];
$action = 'test';
$details = 'done';
include '../../src/config/log-handler.php';

include '1.php';
