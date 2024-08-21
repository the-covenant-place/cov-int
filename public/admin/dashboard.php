<?php

include '../../src/config/database.php';
include '../../src/config/log-handler.php';
$sql = "SELECT member_id, first_name, last_name FROM members";

$result = $mysqli->query($sql);

session_start();

//Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}else {
    $username = htmlspecialchars($_SESSION['username']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/global.css">
    
</head>
<body>
    <header>
        <div class="header-container">
            <div class="navigation">
                <nav class="ham-nav">
                    <div class="ham-menu" id="ham-menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </nav>
                <nav class="navbar">
                    <ul>
                        <li><a href="dashboard.php">Home</a></li>
                        <li><a href="view-members.php">View Members</a></li>
                        <li><a href="../../src/controllers/logout-process.php">Logout</a></li>
                    </ul>
                </nav>
            </div>
            <div class="logo">
                <img id="logo-img" src="../../assets/icons/COVENANT.png" alt="Logo">
            </div>
           
            <div class="greeting">
                <p>Neema yake <?php echo $username; ?></p>
            </div>
            
            <script>
                document.getElementById('ham-menu').addEventListener('click', function(){
                    var navbar = document.querySelector('.navbar');
                    var hamMenu = document.querySelector('ham-menu');

                    if (navbar.style.display === 'block') {
                        navbar.style.display = 'none';
                    } else {
                        navbar.style.display = 'block';
                        hamMenu.classList.toggle('active');
                    }
                })
            </script>
         <div>
    </header>
    <div class="footer"></div>
</body>
</html>

<?php
header('Location: view-members.php');
?>