<?php
include '../includes/dbconnection.php';

$date = $_POST['dt'];



$sql = "INSERT INTO invoice_rec (`product_name`) VALUE ('" . $date . "')";

if ($conn->query($sql) === TRUE) {
    echo ("Data saved successfully");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>