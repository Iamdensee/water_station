<?php
session_start();
include_once "../../connection.php";
$station_id = $_SESSION["owner_station"];

$stmt = $conn->prepare("SELECT *, CONCAT(first_name, ' ', last_name) as name FROM staff_applications WHERE station_id = :station_id AND archive = 0");
$stmt -> execute([
    ":station_id" => $station_id
]);
$applications = $stmt -> fetchAll(PDO::FETCH_ASSOC);
echo json_encode($applications);

?>