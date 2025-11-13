<?php
session_start();
include_once "../../connection.php";
$station_id = $_SESSION["owner_station"];
$quantity = $_POST["quantity"];
$stmt = $conn->prepare("SELECT * FROM stations WHERE station_id =:station_id");
$stmt->execute([
    ":station_id" => $station_id
]);
$station = $stmt->fetch(PDO::FETCH_ASSOC);


if (!empty($quantity)) {
    $new_stocks = $station["stocks"] + $quantity;
    $add_stocks = $conn->prepare("UPDATE stations SET stocks =:new_stocks");
    $add_stocks->execute([
        ":new_stocks" => $new_stocks
    ]);

    echo "stock(s) added";
} else {
    echo "fields must be filled";
}

?>