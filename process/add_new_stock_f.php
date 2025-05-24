<?php
include '../includes/dbconnection.php';

$product = $_POST['product_name'];
$qty = $_POST['qty'];
$date = $_POST['date'];

// echo $product;
// echo $qty;
// echo $date;

$sql1 = "INSERT INTO fl_07 (`date`, `product_product_id`, `op_stock`, `received`, `balance`) VALUES ('$date', '$product', '0', '$qty', '$qty')";
$sql2 = "INSERT INTO fl_08 (`date`, `product_product_id`, `op_stock`, `received`, `balance`) VALUES ('$date', '$product', '0', '0', '0')";


$query = $sql1 . ";" . $sql2;


if ($conn->multi_query($query) === TRUE) {
    echo "Data saved successfully";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>