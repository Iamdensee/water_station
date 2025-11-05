<?php
session_start();
include_once "../../connection.php";
$customer_id = $_SESSION["customer_id"];
$station_id = $_POST["station_id"];
$address = $_POST["address"];
$quantity = $_POST["quantity"];
$date_time_ordered = date("Y-m-d H:i:s");

if (
   !empty($customer_id) &&
   !empty($station_id) &&
   !empty($address) &&
   !empty($quantity)
) {
   $stmt = $conn->prepare("INSERT INTO orders(
   customer_id, station_id, delivery_address, quantity, date_time_ordered, status
   ) VALUES(
   :customer_id, :station_id, :delivery_address, :quantity, :date_time_ordered, :status
   )");
   $stmt->execute([
      ":customer_id" => $customer_id,
      ":station_id" => $station_id,
      ":delivery_address" => $address,
      ":quantity" => $quantity,
      ":date_time_ordered" => $date_time_ordered,
      ":status" => "New Order",
   ]);

   echo "success";
} else {
   echo "Fill all fields";
}


?>