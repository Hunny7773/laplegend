<?php

// Database Configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "lap_legends_k";

// Create Database Connection
$conn = mysqli_connect(
    $servername,
    $username,
    $password,
    $database
);

// Check Database Connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>