<?php
include_once "../../connection.php";

$fname = $_POST["fname"];
$mname = $_POST["mname"];
$lname = $_POST["lname"];
$address = $_POST["address"];
$contact_number = $_POST["contact_number"];
$email = $_POST["email"];
$station = $_POST["station"];

if (
   !empty($fname) &&
   !empty($mname) &&
   !empty($lname) &&
   !empty($contact_number) &&
   !empty($email) &&
   !empty($station)
) {
   $stmt = $conn->prepare("INSERT INTO staff_applications(
   first_name, middle_name, last_name, contact, email, station_name
   ) VALUES(:fname, :mname, :lname, :contact, :email, :station_name)");

   $stmt->execute([
      ":fname" => $fname,
      ":mname" => $mname,
      ":lname" => $lname,
      ":contact" => $contact_number,
      ":email" => $email,
      ":station_name" => $station,
   ]);

   echo "applied";
} else {
   echo "Please fill up all fields";
}
?>