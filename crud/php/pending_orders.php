<?php
session_start();
include_once "../../connection.php";

$station_id = $_SESSION["owner_station"];
$today = date("Y-m-d");

$stmt = $conn->prepare("SELECT *, CONCAT(c.first_name, ' ', c.last_name) as customer_name 
FROM orders o
INNER JOIN stations as s ON o.station_id = s.station_id
INNER JOIN customers as c ON c.customer_id = o.customer_id
INNER JOIN payment as p ON p.order_id = o.order_id
WHERE s.station_id =:station_id AND o.order_status = 'Pending' AND DATE(o.date_time_ordered) = :date

");
$stmt->execute([
    ":station_id" => $station_id,
    ":date" => $today
]);

$pending_orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($pending_orders === []) {
    echo "no rows";
} else {
    echo json_encode($pending_orders);
}

?>