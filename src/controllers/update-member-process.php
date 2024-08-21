<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: ../../public/admin/login.html');
    exit();
}else {
    $username = htmlspecialchars($_SESSION['username']);
}

include '../config/log-handler.php';
include '../config/database.php';

$member_id = isset($_POST['member_id']) ? $mysqli->real_escape_string($_POST['member_id']) :'';
$first_name = isset($_POST['first_name']) ? $mysqli->real_escape_string($_POST['first_name']) :'';
$last_name = isset($_POST['last_name']) ? $mysqli->real_escape_string($_POST['last_name']) :'';
$gender = isset($_POST['gender']) ? $mysqli->real_escape_string($_POST['gender']) :'';
$marital_status = isset($_POST['marital_status']) ? $mysqli->real_escape_string($_POST['marital_status']) :'';
$address = isset($_POST['address']) ? $mysqli->real_escape_string($_POST['address']) :'';
$email = isset($_POST['email']) ? $mysqli->real_escape_string($_POST['email']) :'';
$phone_number = isset($_POST['phone_number']) ? $mysqli->real_escape_string($_POST['phone_number']) :'';
$membership_status = isset($_POST['membership_status']) ? $mysqli->real_escape_string($_POST['membership_status']) :'';

$stmt = $mysqli->prepare("UPDATE members SET first_name = ?, last_name = ?, gender = ?, marital_status = ?, address = ?, email = ?, phone_number = ?, membership_status = ? WHERE member_id = ?");
$stmt->bind_param("ssssssssi", $first_name, $last_name, $gender, $marital_status, $address, $email, $phone_number, $membership_status, $member_id);

$stmt->execute();

header("Location: ../../public/admin/view-member.php?id=" . $member_id);

// header();

$stmt->close();
$mysqli->close();