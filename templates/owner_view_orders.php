<?php
session_start();
if (!isset($_SESSION["owner_id"])) {
   header("Location: ../index.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link rel="stylesheet" href="../styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">
</head>
<body>
    <a href="owner_dashboard.php"> Home </a>
    <a href="owner_manage_station.php"> Manage Station </a>
    <a href=""> Manage Staffs </a>
    <a href="owner_view_orders.php"> View Orders </a>
    <a href=""> View Deliveries </a>
    <a href="../auth/php/logout.php"> Logout </a>

    <h4> Orders </h4>
    <ul id="orders-list"></ul>
</body>
</html>

<script src="../jquery.js"></script>
<script src="../crud/js/fetch.js"></script>
<script>
    fetch_orders();

    window.addEventListener("pageshow", function (event) {
        if (event.persisted) window.location.reload();
    });
</script>