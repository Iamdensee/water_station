<?php
session_start();
include_once "../../connection.php";

$order_id = $_POST["order_id"];
$payment_method = $_POST["payment_method"];
$contact = $_POST["contact"];

// fetch total amount of order
$customer_order = $conn -> prepare("SELECT * 
FROM orders o
INNER JOIN stations as s ON o.station_id = s.station_id 
WHERE customer_id =:customer_id AND order_id =:order_id");

$customer_order -> execute([
   ":customer_id" => $_SESSION["customer_id"],
   ":order_id" => $order_id,
]);
$total_amount = $customer_order ->fetch(PDO::FETCH_ASSOC);

if (
   !empty($order_id) &&
   !empty($payment_method) &&
   !empty($contact)
) {
   $stmt = $conn->prepare("INSERT INTO payment(
   order_id, payment_method, contact_number, e_wallet_number, payment_date_time, total_amount
   ) VALUES(
   :order_id, :payment_method, :contact_number, :e_wallet_number, :payment_date_time, :total_amount
   )");

   $stmt -> execute([
      ":order_id" => $order_id,
      ":payment_method" => $payment_method,
      ":contact_number" => $contact,
      ":e_wallet_number" => null,
      ":payment_date_time" => date("Y-m-d H:i:s"),
      ":total_amount" => $total_amount["quantity"] * $total_amount["price_per_unit"],
   ]);

   $update_order_status = $conn -> prepare("UPDATE orders SET order_status = :status WHERE order_id =:order_id");
   $update_order_status -> execute([
      ":status" => "Pending",
      ":order_id" => $order_id,
   ]);
 
   echo "success";
} else {
   echo "err";
}


?>