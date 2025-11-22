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
    <title>Manage Staffs</title>
    <link rel="stylesheet" href="../styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Quicksand:wght@600&display=swap"
        rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            background: #ffffff;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #0B1437;
            color: #fff;
            padding: 2rem 1rem;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
            flex-shrink: 0;
        }

        .sidebar h4 {
            font-family: 'Quicksand', sans-serif;
            text-align: center;
            font-weight: 600;
            margin-bottom: 2rem;
        }

        .nav-links {
            list-style: none;
            padding: 0;
        }

        .nav-link {
            color: #dfe6ff !important;
            font-weight: 500;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            display: block;
            text-decoration: none;
        }

        .nav-link:hover {
            background-color: #1C3FAA;
            transform: translateX(4px);
            color: #fff !important;
        }

        .nav-link.active {
            background-color: #1C3FAA;
            color: #fff !important;
            font-weight: 600;
        }

        .main-content {
            flex-grow: 1;
            padding: 2rem;
            background: #fff;
        }

        h1 {
            font-family: 'Quicksand', sans-serif;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #0B1437;
        }

        .card {
            border: none;
            border-radius: 15px;
            background: #f8f9fc;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .card-title {
            font-weight: 600;
            color: #0B1437;
        }

        table thead {
            background: #e9eefc;
            font-weight: 600;
        }

        table td,
        table th {
            vertical-align: middle;
        }

        .btn-action {
            padding: 5px 12px;
            border-radius: 8px;
        }

        .btn-approve {
            background: #1C3FAA;
            color: #fff;
        }

        .btn-reject {
            background: #dc3545;
            color: #fff;
        }

        .btn-remove {
            background: #ff4d4d;
            color: #fff;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Owner Panel</h4>

        <ul class="nav-links">
            <li><a href="owner_dashboard.php" class="nav-link">🏠 Dashboard</a></li>
            <li><a href="owner_manage_station.php" class="nav-link">🏭 Manage Station</a></li>
            <li><a href="owner_manage_staffs.php" class="nav-link active">👷 Manage Staffs</a></li>
            <li><a href="owner_view_orders.php" class="nav-link">🛒 View Orders</a></li>
            <li><a href="owner_view_deliveries.php" class="nav-link">🚚 Deliveries</a></li>
            <li><a href="../auth/php/logout.php" class="nav-link text-danger">🚪 Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">

        <h1>Manage Staffs 👷</h1>

        <!-- ACTIVE STAFF SECTION -->
        <div class="card p-4 mb-4">
            <h5 class="card-title mb-3">Active Staffs</h5>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No.</th>
                            <th>Name</th>
                            <th style="width: 160px;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="staffs-table"></tbody>
                </table>
            </div>
        </div>

        <!-- PENDING APPLICATION SECTION -->
        <div class="card p-4">
            <h5 class="card-title mb-3">Pending Applications</h5>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No.</th>
                            <th>Name</th>
                            <th style="width: 200px;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="pending-staffs-table"></tbody>
                </table>
            </div>
        </div>

    </div>

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

</body>

</html>