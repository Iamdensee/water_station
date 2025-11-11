<?php
session_start();
include_once "../../connection.php";

$station_id = $_SESSION["owner_station"];
$today = date("Y-m-d");

$stmt = $conn->prepare("SELECT * , CONCAT(c.first_name, ' ', c.last_name) as customer_name
FROM delivery as d
INNER JOIN orders as o ON o.order_id = d.order_id
INNER JOIN payment as p ON p.order_id = o.order_id
INNER JOIN customers as c ON c.customer_id = o.customer_id
WHERE o.station_id = :station_id AND DATE(d.delivery_date_time) = :today AND o.order_status = 'Pending'
");

$stmt->execute([
    ":station_id" => $station_id,
    ":today" => $today
]);

$delivery = $stmt->fetchALL(PDO::FETCH_ASSOC);

if ($delivery === []) {
    echo "no rows";
} else {
    echo json_encode($delivery);
}
?>