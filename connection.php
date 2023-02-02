<?php

// Database configuration
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "Cyberverse";

// Create database connection
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

// Check connection  
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
