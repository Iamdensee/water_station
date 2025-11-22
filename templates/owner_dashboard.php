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
   <title>Owner Dashboard</title>
   <link rel="stylesheet" href="../styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">

   <!-- Google Fonts -->
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Quicksand:wght@600&display=swap"
         rel="stylesheet">

   <style>
      body {
         min-height: 100vh;
         display: flex;
         background: #ffffff; /* White background for main layout */
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
         align-items: stretch;
         box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
         flex-shrink: 0;
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
         margin: 0;
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
         color: #fff !important;
         transform: translateX(4px);
      }

      .nav-link.active {
         background-color: #1C3FAA;
         color: #fff !important;
         font-weight: 600;
      }

      .nav-link.text-danger:hover {
         background-color: #ff4d4d;
      }

      /* Main Content */
      .main-content {
         flex-grow: 1;
         padding: 2rem;
         background: #fff; /* White clean background */
      }

      h1 {
         font-family: 'Quicksand', sans-serif;
         font-weight: 600;
         margin-bottom: 2rem;
         color: #0B1437;
      }

      .card {
         border: none;
         border-radius: 15px;
         background: #f8f9fc;
         color: #000;
         box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
         transition: transform 0.25s ease;
      }

      .card:hover {
         transform: translateY(-5px);
      }

      .metric-value {
         font-size: 1.8rem;
         font-weight: 700;
         color: #1C3FAA;
      }

      /* Responsive Sidebar */
      @media (max-width: 992px) {
         .sidebar {
            width: 100%;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            padding: 1rem;
         }

         .sidebar h4 {
            display: none;
         }

         .nav-link {
            text-align: center;
            padding: 0.5rem;
         }
      }
   </style>
</head>

<body>

   <!-- Sidebar -->
   <div class="sidebar">
      <h4>Owner Panel</h4>

      <ul class="nav-links">
         <li><a href="owner_dashboard.php" class="nav-link active">🏠 Dashboard</a></li>
         <li><a href="owner_manage_station.php" class="nav-link">🏭 Manage Station</a></li>
         <li><a href="owner_manage_staffs.php" class="nav-link">👷 Manage Staffs</a></li>
         <li><a href="owner_view_orders.php" class="nav-link">🛒 View Orders</a></li>
         <li><a href="owner_view_deliveries.php" class="nav-link">🚚 Deliveries</a></li>
         <li><a href="../auth/php/logout.php" class="nav-link text-danger">🚪 Logout</a></li>
      </ul>
   </div>

   <!-- Main -->
   <div class="main-content">
      <h1>Welcome back, Owner 👋</h1>

      <div class="row g-4">

         <!-- Revenue -->
         <div class="col-md-4">
            <div class="card p-4 text-center">
               <h5>Daily Revenue</h5>
               <p id="revenue-placeholder" class="metric-value">₱0</p>
            </div>
         </div>

         <!-- Stocks Remaining -->
         <div class="col-md-4">
            <div class="card p-4 text-center">
               <h5>Stocks Remaining</h5>
               <p id="stocks-placeholder" class="metric-value">0</p>
            </div>
         </div>

         <!-- Ongoing Deliveries -->
         <div class="col-md-4">
            <div class="card p-4 text-center">
               <h5>Ongoing Deliveries</h5>
               <p id="ongoing-deliveries-placeholder" class="metric-value">0</p>
            </div>
         </div>

         <!-- Delivered -->
         <div class="col-md-4">
            <div class="card p-4 text-center">
               <h5>Delivered Gallons</h5>
               <p id="delivered-placeholder" class="metric-value">0</p>
            </div>
         </div>

         <!-- Pending Orders -->
         <div class="col-md-4">
            <div class="card p-4 text-center">
               <h5>Pending Orders Today</h5>
               <p id="pending-orders-placeholder" class="metric-value">0</p>
            </div>
         </div>

      </div>
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
