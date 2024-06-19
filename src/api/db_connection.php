<?php
$hostName = "localhost";
$username = "root";
$password = "";
$database = "butacabox_v4";

$conn = new mysqli($hostName, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>