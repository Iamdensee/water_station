<?php
session_start();
if (!isset($_SESSION["owner_id"])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>

    <link rel="stylesheet" href="../styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Quicksand:wght@600&display=swap"
          rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: #ffffff;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        /* FIXED SIDEBAR */
        .sidebar {
            width: 250px;
            background-color: #0B1437;
            color: #fff;
            padding: 2rem 1rem;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 4px 0 15px rgba(0,0,0,0.2);
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 2rem;
            font-family: 'Quicksand', sans-serif;
            font-weight: 600;
        }

        .nav-links { list-style: none; padding: 0; }
        .nav-link {
            color: #dfe6ff !important;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            display: block;
            font-weight: 500;
            transition: .3s ease;
            text-decoration: none;
        }
        .nav-link:hover {
            background: #1C3FAA;
            color: #fff !important;
            transform: translateX(4px);
        }
        .nav-link.active { background: #1C3FAA; color: #fff !important; }
        .nav-link.text-danger:hover { background: #ff4d4d; }

        /* MAIN CONTENT SPACING */
        .main-content {
            margin-left: 250px;
            padding: 2rem;
        }

        h1 {
            font-family: 'Quicksand', sans-serif;
            font-weight: 600;
            color: #0B1437;
        }

        /* ORDER CARD STYLE (matching deliveries) */
        .order-card {
            background: #f8f9fc;
            border-radius: 15px;
            padding: 1.3rem 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: transform .2s ease;
        }
        .order-card:hover {
            transform: translateY(-3px);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-status {
            font-weight: 600;
            padding: 0.3rem 0.8rem;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        /* STATUS COLORS */
        .status-pending { background: #fff3cd; color: #856404; }
        .status-approved { background: #cce5ff; color: #004085; }
        .status-preparing { background: #ffe8cc; color: #663c00; }
        .status-completed { background: #d4edda; color: #155724; }
        .status-cancelled { background: #f8d7da; color: #721c24; }

        .order-info p { margin: 0; padding: 2px 0; }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Owner Panel</h4>

        <ul class="nav-links">
            <li><a href="owner_dashboard.php" class="nav-link">🏠 Dashboard</a></li>
            <li><a href="owner_manage_station.php" class="nav-link">🏭 Manage Station</a></li>
            <li><a href="owner_manage_staffs.php" class="nav-link">👷 Manage Staffs</a></li>
            <li><a href="owner_view_orders.php" class="nav-link active">🛒 View Orders</a></li>
            <li><a href="owner_view_deliveries.php" class="nav-link">🚚 Deliveries</a></li>
            <li><a href="../auth/php/logout.php" class="nav-link text-danger">🚪 Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">

        <h1>Orders</h1>

        <div id="orders-list" class="mt-4"></div>

    </div>

</body>
</html>

<script src="../jquery.js"></script>
<script src="../crud/js/fetch.js"></script>

<script>
fetch_orders();

window.addEventListener("pageshow", function(event) {
    if (event.persisted) window.location.reload();
});
</script>
