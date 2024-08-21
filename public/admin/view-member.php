<?php

include '../../src/config/log-handler.php';
include '../../src/config/database.php';

$memberId = $_GET['id'];

$stmt = $mysqli->prepare("SELECT member_id, first_name, last_name, gender, marital_status, address, email, phone_number, membership_status, date_joined FROM members WHERE member_id = ?");
$stmt->bind_param("i", $memberId);
$stmt->execute();


$result = $stmt->get_result();

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
    <link rel="stylesheet" href="../css/view-member.css">
    <link rel="stylesheet" href="../css/global.css">
    <title>Member View</title>
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
    <div class="container">
        <?php
        $member = $result->fetch_assoc();
        echo "<p><span class='label'>First Name: </span><span class='value'>" . $member['first_name'] . "</span></p>";
        echo "<p><span class='label'>Last Name: </span><span class='value'>" . $member['last_name'] . "</span></p>";
        echo "<p><span class='label'>Gender: </span><span class='value'>" . $member['gender'] . "</span></p>";
        echo "<p><span class='label'>Marital: Status </span><span class='value'>" . $member['marital_status'] . "</span></p>";
        echo "<p><span class='label'>Address: </span><span class='value'>" . $member['address'] . "</span></p>";
        echo "<p><span class='label'>e-mail: </span><span class='value'>" . $member['email'] . "</span></p>";
        echo "<p><span class='label'>Phone Number: </span><span class='value'>" . $member['phone_number'] . "</span></p>";
        echo "<p><span class='label'>Membership Status: </span><span class='value'>" . $member['membership_status'] . "</span></p>";
        echo "<p><span class='label'>Date Joined: </span><span class='value'>" . $member['date_joined'] . "</span></p>";
        echo "<button id='editDetails'>Edit Details</button>"
        
        ?>
        
        <script>
            document.getElementById('editDetails').addEventListener('click', function() {
                window.location.href = "edit-details.php?id=<?php echo $member['member_id']; ?>";
            });
        </script>

        <button id="goBackButton">Go Back</button>
        <script>
            document.getElementById('goBackButton').addEventListener('click', function() {
                window.location.href = 'view-members.php';
            });
        </script>
        
    </div>
    
</body>
</html>