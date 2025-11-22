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
$application_id = $_POST["application"];
$fname = $_POST["fname"];
$mname = $_POST["mname"];
$lname = $_POST["lname"];
$contact_number = $_POST["contact_number"];
$email = $_POST["email"];
$station_id = $_POST["station_id"];
$password = $fname . rand(1000, 9999);
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// insert and notify user via email

// EMAIL CONTENT
$subject = "Your application has been approved!";
$message = "Dear $fname,\n\nYou can now login your account with an initial password of $password\n";
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

    // add to staffs
    $approve = $conn->prepare("INSERT INTO staffs(first_name, middle_name, last_name, contact_number, email, password, station_id) 
    VALUES(:fname, :mname, :lname, :contact, :email, :password, :station)");
    $approve->execute([
        ":fname" => $fname,
        ":mname" => $mname,
        ":lname" => $lname,
        ":contact" => $contact_number,
        ":email" => $email,
        ":password" => $password_hash,
        ":station" => $station_id,
    ]);

    // archive application record
    $archive = $conn->prepare("UPDATE staff_applications SET archive = 1 WHERE application_id =:application_id");
    $archive->execute([
        ":application_id" => $application_id
    ]);
    echo "approved";
} catch (Exception $e) {
    echo "Email failed: {$mail->ErrorInfo}";
}

?>