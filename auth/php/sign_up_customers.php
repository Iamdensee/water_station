<?php
include_once "../../connection.php";

$fname = $_POST["fname"];
$mname = $_POST["mname"];
$lname = $_POST["lname"];
$address = $_POST["address"];
$contact_number = $_POST["contact_number"];
$email = $_POST["email"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

if (
   !empty($fname) &&
   !empty($mname) &&
   !empty($lname) &&
   !empty($address) &&
   !empty($contact_number) &&
   !empty($email) &&
   !empty($password)
) {
   $stmt = $conn->prepare("INSERT INTO customers(
   first_name, middle_name, last_name, address, contact_number, email, password
   ) VALUES(:fname, :mname, :lname, :address, :contact_number, :email, :password)");

   $stmt->execute([
      ":fname" => $fname,
      ":mname" => $mname,
      ":lname" => $lname,
      ":address" => $address,
      ":contact_number" => $contact_number,
      ":email" => $email,
      ":password" => $password,
   ]);

   echo "signed up";
} else {
   echo "Please fill up all fields";
}
?>