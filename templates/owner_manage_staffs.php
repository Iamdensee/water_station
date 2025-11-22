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
    <title>Manage Staffs</title>
    <link rel="stylesheet" href="../styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">
</head>

<body>
    <a href="owner_dashboard.php"> Home </a>
    <a href="owner_manage_station.php"> Manage Station </a>
    <a href="owner_manage_staffs.php"> Manage Staffs </a>
    <a href="owner_view_orders.php"> View Orders </a>
    <a href="owner_view_deliveries.php"> View Deliveries </a>
    <a href="../auth/php/logout.php"> Logout </a>

    <h5> Staffs </h5>
    <div>
        <table>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            <tbody id="staffs-table"></tbody>
        </table>
    </div>

    <h5> Pending Applications </h5>
    <div>
        <table>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            <tbody id="pending-staffs-table"></tbody>
        </table>
    </div>

</body>

</html>

<script src="../jquery.js"></script>
<script src="../crud/js/create.js"></script>
<script src="../crud/js/fetch.js"></script>
<script src="../crud/js/delete.js"></script>
<script src="../crud/js/event_listeners.js"></script>
<script>
    fetch_staffs();

    fetch_pending_applications();

    window.addEventListener("pageshow", function (event) {
        if (event.persisted) window.location.reload();
    });
</script>