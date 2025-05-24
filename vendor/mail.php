<?php
session_start();
include '../includes/dbconnection.php';
require 'PHPMailer/PHPMailerAutoload.php';





if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dateContent = isset($_POST['dateContent']) ? $_POST['dateContent'] : '';
    if (isset($_POST['fl07'])) {
        $type = isset($_POST['fl07']) ? $_POST['fl07'] : '';
    } else {
        $type = isset($_POST['fl08']) ? $_POST['fl08'] : '';
    }

    // Check if a file was uploaded
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
        $pdf = $_FILES['pdf']['tmp_name'];



        if (isset($_POST['download']) && $_POST['download'] === 'yes') {
            $pdfContent = file_get_contents($pdf);
            $fileName = $dateContent . '.pdf';
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . strlen($pdfContent));
            echo $pdfContent;
            exit;
        }



        // Configure PHPMailer
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your mail';
        $mail->Password = 'your mail app pwd';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('');
        // $mail->addCC('');
        // $mail->addCC('');
        // $mail->addAddress('');

        $mail->Subject = 'Generated PDF ' . $dateContent . ' ' . $type;
        $mail->Body = 'Please find the attached PDF for ' . $dateContent . '.';


        $mail->addAttachment($pdf, $dateContent . '.pdf');

        // Send email
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {


            if ($_SESSION['type'] == 'admin' && $type == 'fl_08') {
                $sql1 = "INSERT INTO invoice_rec (`date`) VALUES ('$dateContent')";

                if ($conn->query($sql1) === TRUE) {
                    echo 'Message has been sent';
                } else {
                    echo "Error: " . $conn->error;
                }

                $conn->close();
            }else{
                echo 'Message has been sent';
            }

        }
    } else {
        echo 'No PDF received.';
    }
}


?>