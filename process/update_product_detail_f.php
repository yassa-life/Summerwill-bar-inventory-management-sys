<?php
include '../includes/dbconnection.php';

$price = $_POST['product_Price'];
$pid = $_POST['pid'];

// echo $name;
// echo $price;
// echo $pid;

$sql = "UPDATE product set  product.unit_price = '$price' WHERE product.product_id = '$pid'";



if ($conn->query($sql) === TRUE) {
    echo "Data updated successfully";
} else {
    echo "Error updating data: " . $conn->error;
}

$conn->close();
?>