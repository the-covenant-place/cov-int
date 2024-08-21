<?php

$host = "localhost";
$dbname = "the_covenant_place";
$username = "root";
$password = "";

$mysqli = new mysqli(hostname: $host,
                     database: $dbname,
                     username: $username,
                     password: $password);

return $mysqli;