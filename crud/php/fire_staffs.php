<?php
include_once "../../connection.php";
$staff_id = $_POST["staff_id"];

$stmt = $conn -> prepare("DELETE FROM staffs WHERE staff_id =:staff_id");
$stmt -> execute([
    ":staff_id" => $staff_id
]); 
echo "delete";

?>