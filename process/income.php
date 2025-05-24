<?php
include '../includes/dbconnection.php';

$inc = $_POST['income'];
$dt = $_POST['dt'];

$sql = "UPDATE invoice_rec set `income`='".$inc."' WHERE invoice_rec.date = '".$dt."' ";

if ($conn->query($sql) === TRUE) {
    echo ("true");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>