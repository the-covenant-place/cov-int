<?php

// Start session
session_start();

include '../config/log-handler.php';


// Include database connection
require_once '../config/database.php';


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sanitize inputs
    $username = isset($_POST['username']) ? $mysqli->real_escape_string($_POST['username']) :'';

    $password = isset($_POST['password']) ? $mysqli->real_escape_string($_POST['password']) :'';

    // Validate inputs
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username and password are required.";
        header("Location: ../../public/admin/login.html");
        exit();
    }
    
    // Prepare SQL statement
    $stmt = $mysqli->prepare("SELECT user_id, username, password_raw FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();
    $stmt->store_result();


    // Check if other users exist
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $db_username, $db_password);
        $stmt->fetch();


        // Verify Password
        if ($password == $db_password) {
            //  For correct password, start session
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $db_username;
            header("Location: ../../public/admin/dashboard.php");
            
            exit();
        } else {
            //Invalid password
            $_SESSION['error'] = "Invalid username or password.";
            header("Location: ../../public/admin/login.html");
            exit();
        }
    } else {
        //Invalid username
        $_SESSION['error'] = "Invalid username or password.";
        header("Location: ../../public/admin/login.html");
        exit();
    }

    // Close statement and connection 

} else {
    // Redirect if form was not submitted
    header("Location: ../../public/admin/login.html");
    exit();
}

