<?php
include '../config/log-handler.php';


session_start();

session_unset();

session_destroy();

session_regenerate_id(true);

header("Location: ../../public/admin/login.html");

exit();
?>