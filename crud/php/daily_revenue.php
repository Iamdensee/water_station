<?php
session_start();
include_once "../../connection.php";
$station_id = $_SESSION["owner_station"];
$today = date("Y-m-d");

$sales = $conn -> prepare("SELECT *, SUM(p.total_amount) as total_revenue 
FROM payment as p
INNER JOIN orders as o ON o.order_id = p.order_id
INNER JOIN stations as s ON s.station_id = o.station_id
WHERE s.station_id = :station_id AND DATE(o.date_time_ordered) = :date_ordered AND o.order_status = 'Delivered'");
$sales -> execute([
    ":station_id" => $station_id,
    ":date_ordered" => $today
]);
$daily_revenue = $sales -> fetch(PDO::FETCH_ASSOC);

if ($daily_revenue["total_revenue"] === null) {
    echo "no rows";
} else {
    echo json_encode($daily_revenue);
}

?>