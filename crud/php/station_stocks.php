<?php
session_start();
include_once "../../connection.php";

$station_id = $_SESSION["owner_station"];
$stocks = $conn -> prepare("SELECT * FROM stations WHERE station_id = :station_id");
$stocks -> execute([
    ":station_id" =>$station_id
]);
$stocks_left = $stocks -> fetch(PDO::FETCH_ASSOC);
echo json_encode($stocks_left);

?>