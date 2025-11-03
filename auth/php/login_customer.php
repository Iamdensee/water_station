<?php
session_start();
include_once "../../connection.php";
$email = $_POST["email"];
$password = $_POST["password"];

$stmt = $conn->prepare("SELECT * FROM customers WHERE email = :email");
$stmt->execute([
    ":email" => $email,
]);
$customer = $stmt->fetch(PDO::FETCH_ASSOC);

if ($customer !== false) {
    if (password_verify($password, $customer["password"])) {
        $_SESSION["customer_id"] = $customer["customer_id"];
        $_SESSION["customer_name"] = $customer["first_name"];
        echo "granted";
    } else {
        echo "incorrect password/username";
    }
} else {
    echo "invalid account";
}

?>