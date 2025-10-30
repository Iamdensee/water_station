<?php
include_once "../../connection.php";
$email = $_POST["email"];
$password = $_POST["password"];

$stmt = $conn->prepare("SELECT * FROM customer WHERE email = :email AND password = :password");
$stmt->execute([
    ":email" => $email,
    ":password" => $password
]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($student["email"])


    ?>