<?php

session_start();

include '../config/database.php';
include '../config/log-handler.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}else {
    $username = htmlspecialchars($_SESSION['username']);
}

$first_name = isset($_POST['first_name']) ? $mysqli->real_escape_string($_POST['first_name']) :'';
$last_name = isset($_POST['last_name']) ? $mysqli->real_escape_string($_POST['last_name']) :'';
$gender = isset($_POST['gender']) ? $mysqli->real_escape_string($_POST['gender']) :'';
$marital_status = isset($_POST['marital_status']) ? $mysqli->real_escape_string($_POST['marital_status']) :'';
$address = isset($_POST['address']) ? $mysqli->real_escape_string($_POST['address']) :'';
$email = isset($_POST['email']) ? $mysqli->real_escape_string($_POST['email']) :'';
$phone_number = isset($_POST['phone_number']) ? $mysqli->real_escape_string($_POST['phone_number']) :'';
$membership_status = 'active';
$date_joined = date('Y-m-d');

$stmt = $mysqli->prepare("INSERT INTO members (first_name, last_name, gender, marital_status, address, email, phone_number, membership_status, date_joined) VALUES (?, ?, ?, ?, ?, ?, ?, ?, CURRENT_DATE)");
$stmt->bind_param("ssssssss", $first_name, $last_name, $gender, $marital_status, $address, $email, $phone_number, $membership_status);

if ($stmt->execute()) {
    header('Location: ../../public/admin/view-members.php');
} else {
    header('Location: ../../public/admin/add-member.php');
}

$stmt->close();
$mysqli->close();
