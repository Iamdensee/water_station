<?php
include_once "../../connection.php";

$delivery_id = $_POST["delivery_id"];
$order_id = $_POST["order_id"];

if (
    !empty($delivery_id) &&
    !empty($order_id)
) {
    $stmt = $conn -> prepare("UPDATE delivery SET delivery_status =:status WHERE delivery_id =:delivery_id");
    $stmt -> execute([
        ":status" => "Delivered",
        ":delivery_id" => $delivery_id,
    ]);

    $delivery_status = $conn -> prepare("UPDATE orders SET order_status =:status WHERE order_id =:order_id");
    $delivery_status -> execute([
        ":status" => "Delivered",
        ":order_id" => $order_id
    ]);

    echo "updated";

} else {
    echo "err";
}

?>