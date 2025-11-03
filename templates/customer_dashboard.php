<?php
session_start();

if(!isset($_SESSION["customer_id"])) {
   header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title> Dashboard </title>
</head>
<body>
   <h1>Welcome <?php echo($_SESSION['customer_name'])?></h1>
   <a href="customer_dashboard.php"> Home </a>
   <a href=""> Water Stations </a>
   <a href=""> Order </a>
   <a href=""> My Orders </a>
   <a href=""> Notification </a>
   <a href=""> My Account </a>
   <a href="../auth/php/logout.php"> Logout </a>
</body>
</html>

<script src="../jquery.js"></script>
<script>
   window.addEventListener("pageshow", function (event) {
        if (event.persisted) {
            window.location.reload();
        }
    });
</script>