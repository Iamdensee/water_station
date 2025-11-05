<?php
session_start();
include_once "../../connection.php";
$email = $_POST["email"];
$password = $_POST["password"];

$stmt = $conn->prepare("SELECT * FROM staffs WHERE email = :email");
$stmt->execute([
    ":email" => $email,
]);
$staff = $stmt->fetch(PDO::FETCH_ASSOC);

if ($staff !== false) {
    if (password_verify($password, $staff["password"])) {
        $_SESSION["staff_id"] = $staff["staff_id"];
        $_SESSION["staff_name"] = $staff["first_name"];
        $_SESSION["staff_station"] = $staff["station_id"];
        echo "granted";
    } else {
        echo "incorrect password/username";
    }
} else {
    echo "invalid account";
}

?>