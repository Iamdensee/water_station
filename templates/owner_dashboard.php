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
    <title>Dashboard</title>
    <link rel="stylesheet" href="../styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">
</head>
<body>
    <a href="owner_dashboard.php"> Home </a>
    <a href="owner_manage_station.php"> Manage Station </a>
    <a href="owner_manage_staffs.php"> Manage Staffs </a>
    <a href="owner_view_orders.php"> View Orders </a>
    <a href="owner_view_deliveries.php"> View Deliveries </a>
    <a href="../auth/php/logout.php"> Logout </a>

    <div>
        <h4>Daily Revenue: </h4> <p id="revenue-placeholder"></p>
    </div>

    <div>
        <h4>Stocks Remaining: </h4> <p id="stocks-placeholder"></p>
    </div>

    <div>
        <h4>Ongiong Deliveries: </h4> <p id="ongoing-deliveries-placeholder"></p>
    </div>

    <div>
        <h4>Delivered Galloons: </h4> <p id="delivered-placeholder"></p>
    </div>

    <div>
        <h4>Pending Orders Today: </h4> <p id="pending-orders-placeholder"></p>
    </div>
</body>
</html>

<script src="../jquery.js"></script>
<script src="../crud/js/fetch.js"></script>
<script>
    dashboard_report();

    window.addEventListener("pageshow", function (event) {
         if (event.persisted) window.location.reload();
      });
</script>
