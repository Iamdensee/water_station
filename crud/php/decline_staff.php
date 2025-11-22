<?php
session_start();
include_once "../../connection.php";

require "../../PHPMailer-master/src/PHPMailer.php";
require "../../PHPMailer-master/src/Exception.php";
require "../../PHPMailer-master/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

date_default_timezone_set('Asia/Singapore');
$date = date("Y-m-d");
$time = date("H:i");
$application_id = $_POST["application_id"];
$fname = $_POST["fname"];
$email = $_POST["email"];

// delete and notify user via email

// EMAIL CONTENT
$subject = "Your application has been declined!";
$message = "Dear $fname,\n\nUnfortunately, we decided to decline you application request\n";
$message .= "Date: $date \n";
$message .= "Time: $time\n";

// SEND EMAILS
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'waterstation80@gmail.com';
    $mail->Password = 'jihl vpjn xrlu thhp';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('no-reply@yourdomain.com', 'AQUA');

    $mail->addAddress($email);

    $mail->isHTML(false);
    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();

    // archive application record
    $archive = $conn->prepare("UPDATE staff_applications SET archive = 1 WHERE application_id =:application_id");
    $archive->execute([
        ":application_id" => $application_id
    ]);
    echo "rejected";
} catch (Exception $e) {
    echo "Email failed: {$mail->ErrorInfo}";
}

?>