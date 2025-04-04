<?php
// Database connection settings
$servername = "localhost";  // Replace with your database server if it's not localhost
$username = "root";         // Replace with your database username
$password = "";             // Replace with your database password
$dbname = "main";           // Database name

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Optionally, you can set the character set to UTF-8 for proper encoding
$con->set_charset("utf8");

// Success message (for debugging)
echo "Connected successfully";
?>
