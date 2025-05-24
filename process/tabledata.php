<?php
session_start();
include '../includes/dbconnection.php';

$dateside[] = '';
$incomeside[]= '';

$data = "SELECT `date`,`income` FROM invoice_rec ORDER BY date DESC LIMIT 10";
$data_rw = mysqli_query($conn, $data);

if ($data_rw->num_rows > 0) {
    while ($row = $data_rw->fetch_assoc()) {
        $dateside[] = $row['date'];
        $incomeside[] = $row['income'];
    }
    $response = [
        'dateside' => array_reverse($dateside),
        'incomeside' => array_reverse($incomeside)
    ];
    echo json_encode($response);
} else {
    echo json_encode(['dateside' => [], 'incomeside' => []]);
}

$conn->close();
?>