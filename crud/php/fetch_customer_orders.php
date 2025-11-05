<?php
session_start();
include_once "../../connection.php";

$customer_id = $_SESSION["customer_id"];

$stmt = $conn -> prepare("SELECT * 
FROM orders o
INNER JOIN stations as s ON o.station_id = s.station_id
WHERE customer_id =:customer_id

");
$stmt -> execute([
   ":customer_id" => $customer_id
]);

$customer_order = $stmt -> fetchAll(PDO::FETCH_ASSOC);
echo json_encode($customer_order);
?>