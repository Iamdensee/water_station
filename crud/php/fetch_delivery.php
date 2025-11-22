<?php
session_start();
include_once "../../connection.php";


if (isset($_SESSION["staff_station"])) {
    $station_id = $_SESSION["staff_station"];

} else {
    $station_id = $_SESSION["owner_station"];
}

$stmt = $conn->prepare("SELECT * , CONCAT(c.first_name, ' ', c.last_name) as customer_name
FROM delivery as d
INNER JOIN orders as o ON o.order_id = d.order_id
INNER JOIN payment as p ON p.order_id = o.order_id
INNER JOIN customers as c ON c.customer_id = o.customer_id
WHERE o.station_id = :station_id
");

$stmt->execute([
    ":station_id" => $station_id
]);

$delivery = $stmt->fetchALL(PDO::FETCH_ASSOC);
echo json_encode($delivery);
?>