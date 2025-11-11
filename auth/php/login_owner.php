<?php
session_start();
include_once "../../connection.php";
$email = $_POST["email"];
$password = $_POST["password"];

$stmt = $conn->prepare("SELECT * FROM owners WHERE email = :email");
$stmt->execute([
    ":email" => $email,
]);
$owner = $stmt->fetch(PDO::FETCH_ASSOC);

if ($owner !== false) {
    if (password_verify($password, $owner["password"])) {
        $_SESSION["owner_id"] = $owner["owner_id"];
        $_SESSION["owner_name"] = $owner["first_name"];
        $_SESSION["owner_station"] = $owner["station_id"];
        echo "granted";
    } else {
        echo "incorrect password/username";
    }
} else {
    echo "invalid account";
}

?>