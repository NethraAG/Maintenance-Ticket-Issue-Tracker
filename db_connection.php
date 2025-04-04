<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "main"; // Your database name

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
