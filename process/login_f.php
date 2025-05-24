<?php
session_start();
include '../includes/dbconnection.php';

// Get the POST data
$username = $_POST['user'];
$password = $_POST['pwd'];


// echo ($password . $username);


$stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND pwd = ?");
$stmt->bind_param("ss", $username, $password);


if ($stmt->execute()) {
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $username;
        $_SESSION['type'] = $user['role'];
        // echo $user['role'];
        echo "SUCCESS";
    } else {
        // Authentication failed
        echo "FAILURE";
    }

    $stmt->close();
} else {
    // Execution failed
    echo "ERROR: " . $stmt->error . $stmt;
}

$conn->close();
?>