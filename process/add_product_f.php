<?php
include '../includes/dbconnection.php';

$name = $_POST['product_name'];
$price = $_POST['product_Price'];
$vol = $_POST['product_vol'];
$type = $_POST['product_type'];



$sql = "INSERT INTO product (`product_name`, `unit_price`,`type`) VALUE ('" . $vol . " " . $name . "', '" . $price . "', '" . $type . "')";

if ($conn->query($sql) === TRUE) {
    echo ("Data saved successfully");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>