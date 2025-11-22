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
    <title>Manage Station</title>

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
            display: flex;
            font-family: 'Poppins', sans-serif;
        }

        /* FIXED SIDEBAR */
        .sidebar {
            width: 250px;
            background-color: #0B1437;
            color: #fff;
            padding: 2rem 1rem;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
        }

        .sidebar h4 {
            font-family: 'Quicksand', sans-serif;
            font-weight: 600;
            text-align: center;
            margin-bottom: 2rem;
        }

        .nav-links {
            list-style: none;
            padding: 0;
        }

        .nav-link {
            color: #dfe6ff !important;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            display: block;
            transition: .3s ease;
            font-weight: 500;
        }

        .nav-link:hover {
            background: #1C3FAA;
            color: #fff !important;
            transform: translateX(4px);
        }

        .nav-link.active {
            background: #1C3FAA;
            color: #fff !important;
        }

        .nav-link.text-danger:hover {
            background: #ff4d4d;
        }

        /* MAIN CONTENT SPACING */
        .main-content {
            margin-left: 250px;
            padding: 2rem;
            flex-grow: 1;
        }

        h1,
        h4 {
            font-family: 'Quicksand', sans-serif;
            font-weight: 600;
            color: #0B1437;
        }

        /* CARD STYLES (matching Orders & Deliveries) */
        .station-card {
            background: #f8f9fc;
            border-radius: 15px;
            padding: 1.4rem 1.6rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform .2s ease;
        }

        .station-card:hover {
            transform: translateY(-3px);
        }

        .station-card h4 {
            font-weight: 600;
            font-size: 1.3rem;
            color: #0B1437;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .station-info p {
            margin: 0;
            padding: 3px 0;
            font-size: 1.05rem;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Owner Panel</h4>

        <ul class="nav-links">
            <li><a href="owner_dashboard.php" class="nav-link">🏠 Dashboard</a></li>
            <li><a href="owner_manage_station.php" class="nav-link active">🏭 Manage Station</a></li>
            <li><a href="owner_manage_staffs.php" class="nav-link">👷 Manage Staffs</a></li>
            <li><a href="owner_view_orders.php" class="nav-link">🛒 View Orders</a></li>
            <li><a href="owner_view_deliveries.php" class="nav-link">🚚 Deliveries</a></li>
            <li><a href="../auth/php/logout.php" class="nav-link text-danger">🚪 Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">

        <h1>Manage Station</h1>

        <!-- Remaining Stocks Card -->
        <div class="station-card">
            <h4><i class="bi bi-droplet-half"></i> Remaining Stocks</h4>

            <div class="station-info mt-2">
                <p id="stocks-placeholder"></p>
            </div>

            <button class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#add_stocks">
                Add/Edit Stocks
            </button>
        </div>

        <!-- Price Per Gallon Card -->
        <div class="station-card">
            <h4><i class="bi bi-cash-stack"></i> Price per Gallon</h4>

            <div class="station-info mt-2">
                <p id="price-placeholder"></p>
            </div>

            <button class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#change_price">
                Change Price
            </button>
        </div>

        <!-- ADD STOCKS MODAL -->
        <div class="modal fade" id="add_stocks" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content shadow" style="border-radius: 18px; overflow: hidden;">

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-plus-circle"></i> Add Stocks
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body bg-light">
                        <h6 class="fw-semibold text-center mb-3">Update Station Inventory</h6>

                        <form id="frm-add-stocks" class="text-center">
                            <div class="mb-3">
                                <input type="number" class="form-control form-control-lg" placeholder="Enter Quantity"
                                    id="add-stocks" required>
                            </div>

                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="bi bi-check-circle"></i> Confirm
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- CHANGE PRICE MODAL -->
        <div class="modal fade" id="change_price" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content shadow" style="border-radius: 18px; overflow: hidden;">

                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">
                            <i class="bi bi-cash"></i> Change Price
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body bg-light">
                        <h6 class="fw-semibold text-center mb-3">Set New Unit Price</h6>

                        <form id="frm-change-price" class="text-center">
                            <div class="mb-3">
                                <input type="number" class="form-control form-control-lg" placeholder="Enter New Price"
                                    id="change-price" required>
                            </div>

                            <button type="submit" class="btn btn-success px-4 py-2">
                                <i class="bi bi-check-lg"></i> Save
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>

</body>

</html>

<script src="../jquery.js"></script>
<script src="../crud/js/create.js"></script>
<script src="../crud/js/fetch.js"></script>
<script src="../crud/js/update.js"></script>
<script src="../styles/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>

<script>
    $("#frm-add-stocks").submit(function (e) {
        e.preventDefault();
        add_stocks($("#add-stocks").val().trim());
    });

    $("#frm-change-price").submit(function (e) {
        e.preventDefault();
        change_price($("#change-price").val().trim());
    });

    dashboard_report();

    window.addEventListener("pageshow", function (event) {
        if (event.persisted) window.location.reload();
    });
</script>