<?php
$servername = "localhost";
$username = "root";
$password = "your username";
$dbname = "your DB pwd";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
