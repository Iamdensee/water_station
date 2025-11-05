<?php
session_start();
include_once "../../connection.php";
$staff_id = $_SESSION["staff_id"];
$staff_station = $_SESSION["staff_station"];
$order_id = $_POST["order_id"];
$delivery_date_time = date("Y-m-d H:i:s");

//retrieve the station to deduct the stocks
$station_stocks = $conn->prepare("SELECT * 
FROM orders as o
INNER JOIN stations as s ON s.station_id = o.station_id
WHERE s.station_id =:station_id AND o.order_id =:order_id");

$station_stocks->execute([
   ":station_id" => $staff_station,
   ":order_id" => $order_id,
]);
$deduct_stocks = $station_stocks->fetch(PDO::FETCH_ASSOC);
$current_stocks = $deduct_stocks["stocks"] - $deduct_stocks["quantity"];

if (
   !empty($staff_id) &&
   !empty($order_id) &&
   !empty($delivery_date_time)
) {
   $stmt = $conn->prepare("INSERT INTO delivery(order_id, staff_id, delivery_date_time, status) VALUES(:order_id, :staff_id, :delivery_date_time, :status)");
   $stmt->execute([
      ":order_id" => $order_id,
      ":staff_id" => $staff_id,
      ":delivery_date_time" => $delivery_date_time,
      ":status" => "Out for Delivery",
   ]);

   $update_order_status = $conn->prepare("UPDATE orders SET status = :status WHERE order_id =:order_id");
   $update_order_status->execute([
      ":status" => "Out for Delivery",
      ":order_id" => $order_id,
   ]);

   $update_stocks = $conn -> prepare("UPDATE stations SET stocks =:new_stocks WHERE station_id =:station_id");
   $update_stocks -> execute([
      ":new_stocks" => $current_stocks,
      ":station_id" => $staff_station
   ]);

   echo "success";
} else {
   echo "err";
}

?>