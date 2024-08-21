<?php

include '../../src/config/log-handler.php';
include '../../src/config/database.php';
include '../../log-scripts/log-activity.php';



session_start();

//Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}else {
    $username = htmlspecialchars($_SESSION['username']);
}

$memberId = $_GET['id'];

$stmt = $mysqli->prepare("SELECT member_id, first_name, last_name, gender, marital_status, address, email, phone_number, membership_status, date_joined FROM members WHERE member_id = ?");
$stmt->bind_param("i", $memberId);
$stmt->execute();


$result = $stmt->get_result();

$member = $result->fetch_assoc();

$member_id = $member['member_id'];
$first_name = $member['first_name'];
$last_name = $member['last_name'];
$gender = $member['gender'];
$marital_status = $member['marital_status'];
$address = $member['address'];
$email = $member['email'];
$phone_number = $member['phone_number'];
$membership_status = $member['membership_status'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/form-styles.css">
    <link rel="stylesheet" href="../css/edit-details.css">
    <title>Edit Member Details</title>
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
        <form action="../../src/controllers/update-member-process.php" method="post">
            <input type="hidden" name="member_id" value="<?php echo $member_id; ?>">
        
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo $first_name; ?>">

            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo $last_name; ?>">

            <label for="gender">Gender</label>
            <select id="gender" name="gender">
                <option value="male" <?php if ($member['gender'] == 'male') echo 'selected'; ?>>male</option>
                <option value="female" <?php if ($member['gender'] == 'female') echo 'selected'; ?>>female</option>
            </select>

            <label for="marital_status">Marital Status</label>
            <select id="marital_status" name="marital_status">
                <option value="single" <?php if ($member['marital_status'] == 'single') echo 'selected'; ?>>single</option>
                <option value="married" <?php if ($member['marital_status'] == 'married') echo 'selected'; ?>>married</option>
                <option value="divorced" <?php if ($member['marital_status'] == 'divorced') echo 'selected'; ?>>divorced</option>
                <option value="widowed" <?php if ($member['marital_status'] == 'widowed') echo 'selected'; ?>>widowed</option>
            </select>

            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="<?php echo $address; ?>">

            <label for="email">e-mail</label>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>">

            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" value="<?php echo $phone_number; ?>">

            <label for="membership_status">Membership Status</label>
            <select id="membership_status" name="membership_status">
                <option value="active" <?php if ($member['marital_status'] == 'active') echo 'selected'; ?>>active</option>
                <option value="inactive" <?php if ($member['marital_status'] == 'inactive') echo 'selected'; ?>>inactive</option>
                <option value="deceased" <?php if ($member['marital_status'] == 'deceased') echo 'selected'; ?>>deceased</option>
            </select>

            <input type="submit" value="Confirm">
        </form>
    </div>

    
</body>
</html>