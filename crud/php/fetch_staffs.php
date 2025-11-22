<?php
session_start();
include_once "../../connection.php";
$station_id = $_SESSION["owner_station"];

$stmt = $conn -> prepare("SELECT *, CONCAT(s.first_name, ' ', s.last_name) as staff_name
FROM staffs as s
WHERE station_id =:station_id");
$stmt -> execute([
    ":station_id" => $station_id
]);
$staffs = $stmt -> fetchAll(PDO::FETCH_ASSOC);
echo json_encode($staffs);


?>