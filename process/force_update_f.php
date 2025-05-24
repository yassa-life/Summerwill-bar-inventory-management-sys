<?php
include '../includes/dbconnection.php';

$date = $_POST['date'];

$fl_08 = false;
$fl_07 = false;


$sql = "SELECT MAX(`date`) AS last_date FROM fl_07;";

$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $last_date = $row['last_date'];



    if ($last_date < $date) {
        $sql_getdata = "SELECT * FROM `fl_07` WHERE date='$last_date'";
        $result_getdata = mysqli_query($conn, $sql_getdata);

        if ($result_getdata) {

            while ($rows_data = mysqli_fetch_assoc($result_getdata)) {
                $product_id = $rows_data['product_product_id'];
                $balance = $rows_data['balance'];


                $sql_insert = "INSERT INTO `fl_07` (`date`,`product_product_id`,`op_stock`,`balance`) VALUES ('$date','$product_id','$balance','$balance') ";

                if ($conn->query($sql_insert) === FALSE) {
                    echo "Error fl_7: " . $sql_insert . "<br>" . $conn->error;
                } else {
                    $fl_07 = true;
                }
            }
        } else {
            echo "Error fetching previous data fl_07: " . mysqli_error($conn);
        }
        $sql_getdat = "SELECT * FROM `fl_08` WHERE `date`='$last_date'";
        $result_getdat = mysqli_query($conn, $sql_getdat);

        if ($result_getdat) {



            while ($rows_dat = mysqli_fetch_assoc($result_getdat)) {
                $product_i = $rows_dat['product_product_id'];
                $balanc = $rows_dat['balance'];


                $sql_insert = "INSERT INTO `fl_08` (`date`,`product_product_id`,`op_stock`,`balance`) VALUES ('$date','$product_i','$balanc','$balanc') ";

                if ($conn->query($sql_insert) === FALSE) {
                    echo "Error fl_08: " . $sql_insert . "<br>" . $conn->error;
                } else {
                    $fl_08 = true;
                }
            }
        } else {
            echo "Error fetching previous data fl_08: " . mysqli_error($conn);
        }

    } else {
        echo "Something went wrong code=data_p123";
    }
}






if ($fl_07 && $fl_08) {
    echo "Force Updated!";
}

//
$conn->close();
?>