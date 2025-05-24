<?php
include '../includes/dbconnection.php';

$pid = $_POST["pid"];
$secid = trim($pid);
$sold = $_POST["sold"];
$sale = $_POST["sale"];
$balance = $_POST["blnc"];
$date = $_POST["date"];


$sql1 = "UPDATE fl_08 SET fl_08.sold='$sold', fl_08.balance='$balance', fl_08.sale_amount='$sale' WHERE fl_08.id='$secid'";

if (mysqli_query($conn, $sql1)) {

    echo "SUCCESS";
    
} else {
    echo "Error updating data in fl_08: " . mysqli_error($conn);
}




$conn->close();
?>