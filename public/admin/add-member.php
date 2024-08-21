<?php

include '../../src/config/database.php';
include '../../src/config/log-handler.php';

session_start();

//Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../public/admin/login.html');
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
    <title>Add Member</title>
    <link rel="stylesheet" href="../css/form-styles.css">
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
    <div class="form-container">
        <form action="../../src/controllers/add-member-process.php" method="post">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name">

            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name">

            <label for="gender">Gender</label>
            <div>
                <select id="gender" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <label for="marital_status">Marital Status</label>
            <select id="marital_status" name="marital_status">
                <option value="single">Single</option>
                <option value="married">Married</option>
                <option value="divorced">Divorced</option>
                <option value="widowed">Widowed</option>
            </select>

            <label for="address">Address</label>
            <input type="text" name="address" id="address">

            <label for="email">eMail</label>
            <input type="text" name="email" id="email">

            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number">

            <input type="submit" value="Add Member">
        </form>
    </div>
    
</body>
</html>