<?php
include_once "../../connection.php";

$stmt = $conn->prepare("SELECT * FROM stations");
$stmt->execute();
$stations = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($stations);

//owner view price


?>