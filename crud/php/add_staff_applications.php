<?php
include_once "../../connection.php";

$station_id = $_POST["station_id"];
$fname = $_POST["fname"];
$mname = $_POST["mname"];
$lname = $_POST["lname"];
$contact_number = $_POST["contact_number"];
$email = $_POST["email"];
$station = $_POST["station_id"];

if (
   !empty($fname) &&
   !empty($mname) &&
   !empty($lname) &&
   !empty($contact_number) &&
   !empty($email) &&
   !empty($station)
) {
   $stmt = $conn->prepare("INSERT INTO staff_applications(
   first_name, middle_name, last_name, contact_number, email, station_id
   ) VALUES(:fname, :mname, :lname, :contact, :email, :station_id)");

   $stmt->execute([
      ":fname" => $fname,
      ":mname" => $mname,
      ":lname" => $lname,
      ":contact" => $contact_number,
      ":email" => $email,
      ":station_id" => $station,
   ]);

   echo "applied";
} else {
   echo "Please fill up all fields";
}
?>