<?php
session_start();
include_once "../../connection.php";

//customer view
if (isset($_SESSION["customer_id"])) {
   $customer_id = $_SESSION["customer_id"];
   $stmt = $conn->prepare("SELECT * 
FROM orders o
INNER JOIN stations as s ON o.station_id = s.station_id
WHERE customer_id =:customer_id

");
   $stmt->execute([
      ":customer_id" => $customer_id
   ]);

   $customer_order = $stmt->fetchAll(PDO::FETCH_ASSOC);
   echo json_encode($customer_order);

//onwer view
} else {
   $station_id = $_SESSION["owner_station"];
   $order = $conn->prepare("SELECT * 
FROM orders o
INNER JOIN stations as s ON o.station_id = s.station_id
WHERE s.station_id =:station_id ");
   $order->execute([
      ":station_id" => $station_id
   ]);
   $orders = $order -> fetchAll(PDO::FETCH_ASSOC);
   echo json_encode($orders);
}

?>