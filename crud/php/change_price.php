<?php
session_start();
include_once "../../connection.php";
$new_price = $_POST["price"];
$station_id = $_SESSION["owner_station"];

if (!empty($new_price)) {
    $stmt = $conn->prepare("UPDATE stations SET price_per_unit =:new_price WHERE station_id =:station_id");
    $stmt->execute([
        ":new_price" => $new_price,
        ":station_id" => $station_id
    ]);

    echo "price changed";
} else {
    echo "Price must not be empty";
}

?>