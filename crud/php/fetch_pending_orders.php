<?php
session_start();
include_once "../../connection.php";

$station_id = $_SESSION["staff_station"];

$stmt = $conn -> prepare("SELECT *, CONCAT(c.first_name, ' ', c.last_name) as customer_name 
FROM orders o
INNER JOIN stations as s ON o.station_id = s.station_id
INNER JOIN customers as c ON c.customer_id = o.customer_id
INNER JOIN payment as p ON p.order_id = o.order_id
WHERE s.station_id =:station_id AND o.status = 'Pending'

");
$stmt -> execute([
   ":station_id" => $station_id,
]);

$pending_orders = $stmt -> fetchAll(PDO::FETCH_ASSOC);
echo json_encode($pending_orders);
?>