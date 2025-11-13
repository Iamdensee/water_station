<?php
session_start();
include_once "../../connection.php";

if (isset($_SESSION["customer_id"])) {
    $stmt = $conn->prepare("SELECT * FROM stations");
    $stmt->execute();
    $stations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($stations);

//owner view price
} else {
    $station_id = $_SESSION["owner_station"];
    $price = $conn -> prepare("SELECT * FROM stations WHERE station_id =:station_id");
    $price -> execute([
        ":station_id" => $station_id
    ]);
    $price_per_unit = $price -> fetch(PDO::FETCH_ASSOC);
    echo json_encode($price_per_unit["price_per_unit"]);
}


?>