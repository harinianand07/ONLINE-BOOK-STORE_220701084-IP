<?php
// db_connection.php
$servername = "localhost"; // or your server name
$username = "root"; // replace with your database username
$password = "harini07"; // replace with your database password
$dbname = "bookify_1"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
