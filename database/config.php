<?php
//connection

$servername = "localhost"; // Database host
$username = "root"; // Database username
$password = ""; // Database password
$database = "proj_fsalms"; // Database name
$port = 3306; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>