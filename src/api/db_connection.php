<?php
$hostName = "localhost";
$username = "root";
$password = "";
$database = "butacabox_v3";

// Create connection
$conn = new mysqli($hostName, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>