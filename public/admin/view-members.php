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
    <link rel="stylesheet" href="../css/table-styles.css">
    <link rel="stylesheet" href="../css/view-members-styles.css">

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
    <div class="add-member">
        <button class="add-member-button" id="addMemberButton">Add Member</button>
        <script>
            document.getElementById('addMemberButton').addEventListener('click', function() {
                window.location.href = 'add-member.php';
            });
        </script>
    </div>
    <div class="table-container">
        <table border="1">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
            </tr>
            <?php
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    echo"<tr>";
                        echo "<td>" . $row["member_id"]."</td>";
                        echo "<td>" . $row["first_name"]."</td>";
                        echo "<td>" . $row["last_name"]."</td>";
                        echo "<td><a href='view-member.php?id=" . $row['member_id'] . "'><button>View Details</button></a></td>";
                    echo "</tr>";
                }   
            }
            ?>
        </table>
    </div>
    <div class="footer"></div>
</body>
</html>

<?php
?>