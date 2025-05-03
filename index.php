<?php
session_start();

// Check if session is set
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edu Authorities Student Management System|| Login Page</title>
    <link rel="stylesheet" href="assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .content-wrapper {
            background-image: url('assets/images/bar.jpg');
            background-size: cover;
        }
        ::-ms-input-placeholder { /* Edge 12-18 */
  color: red;
}
    </style>

</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div style="opacity: 0.8;" class="auth-form-light text-center p-5">
                         
                            <form class="pt-3" id="loginForm" onsubmit="return false;">
                                <div  class="form-group">
                                <h4 style="color: black;">Username</h4>
                                    <input style="border-color: black;border-radius: 10px;" type="text" class="form-control form-control-lg"
                                        placeholder="enter your username" required id="username">
                                </div>
                                <div class="form-group">
                                    
                                <h4 style="color: black;">Password</h4>
                                    <input style="border-color: black;border-radius: 10px;" type="password" class="form-control form-control-lg"
                                        placeholder="enter your password" id="password" required>
                                </div>
                                <div class="mt-3">
                                    <button onclick="login()" class="btn btn-success btn-block loginbtn">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="process.js"></script>
</body>

</html>