<?php
include '../includes/dbconnection.php';

$pid = $_POST["pid"];
$secid = trim($pid);
$receiv = $_POST["received"];
$sent = $_POST["sent"];
$balance = $_POST["blnc"];
$date = $_POST["date"];



$sql1 = "UPDATE fl_07 SET fl_07.received='$receiv', fl_07.balance='$balance', fl_07.to_fl_08='$sent' WHERE fl_07.id='$secid'";

if (mysqli_query($conn, $sql1)) {

    $selectSql = "SELECT * FROM fl_07 WHERE fl_07.id='$secid'";
    $result = mysqli_query($conn, $selectSql);


    if (mysqli_num_rows($result)>0) {
        $row = mysqli_fetch_assoc($result);
        $product_product_id = $row['product_product_id'];
        $sql2 = "UPDATE fl_08 SET fl_08.received='$sent', fl_08.balance='$sent' WHERE fl_08.product_product_id='$product_product_id' AND fl_08.date = '$date'";

        if (mysqli_query($conn, $sql2)) {
            echo "asd".mysqli_error($conn).$secid.$receiv.$sent.$balance.$date.$row['op_stock'];
        } else {
            echo "Error updating data in fl_08: " . mysqli_error($conn);
        }
    } else {
        echo "Error fetching updated data: " . mysqli_error($conn);
    }
} else {
    echo "Error updating data in fl_07: " . mysqli_error($conn);
}




$conn->close();
?>