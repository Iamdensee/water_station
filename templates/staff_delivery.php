<?php
session_start();
if (!isset($_SESSION["staff_id"])) {
   header("Location: ../index.php");
   exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Deliveries</title>
   <link rel="stylesheet" href="../styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Quicksand:wght@600&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

   <style>
      body {
         min-height: 100vh;
         background: linear-gradient(135deg, #0D1B2A, #1C3FAA);
         color: #fff;
         font-family: 'Poppins', sans-serif;
         margin: 0;
         display: flex;
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
         position: fixed;
         top: 0;
         left: 0;
         height: 100vh;
         overflow-y: auto;
         z-index: 1000;
      }

      .sidebar img {
         width: 90px;
         height: 90px;
         border-radius: 50%;
         border: 2px solid #fff;
         margin: 0 auto 1rem auto;
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

      .nav-links li {
         margin-bottom: 0.5rem;
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
         margin-left: 250px;
         overflow-y: auto;
         height: 100vh;
      }

      h1 {
         font-family: 'Quicksand', sans-serif;
         font-weight: 600;
         margin-bottom: 2rem;
         display: flex;
         align-items: center;
         gap: 10px;
      }

      /* Delivery Cards */
      .delivery-card {
         background: rgba(255, 255, 255, 0.12);
         border-radius: 15px;
         padding: 1.25rem 1.5rem;
         margin-bottom: 1rem;
         backdrop-filter: blur(10px);
         box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
         transition: all 0.3s ease;
      }

      .delivery-card:hover {
         background: rgba(255, 255, 255, 0.2);
         transform: translateY(-4px);
      }

      .delivery-header {
         display: flex;
         justify-content: space-between;
         align-items: center;
         flex-wrap: wrap;
         border-bottom: 1px solid rgba(255,255,255,0.2);
         padding-bottom: 0.5rem;
         margin-bottom: 0.75rem;
      }

      .delivery-header h5 {
         margin: 0;
         font-weight: 600;
      }

      .delivery-status {
         font-weight: 600;
         text-transform: capitalize;
         font-size: 0.9rem;
         display: flex;
         align-items: center;
         gap: 5px;
      }

      .status-pending { color: #f0ad4e; }
      .status-approved { color: #00bfff; }
      .status-delivered { color: #00b67a; }
      .status-cancelled { color: #ff4d4d; }

      .delivery-info p {
         margin: 0.25rem 0;
         font-size: 0.95rem;
         color: #dfe6ff;
      }

      .action-btns {
         margin-top: 1rem;
      }

      .action-btns button {
         border-radius: 8px;
         font-size: 0.9rem;
      }

      @media (max-width: 992px) {
         .sidebar {
            width: 100%;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            height: auto;
            position: relative;
            padding: 1rem;
         }

         .sidebar img,
         .sidebar h4 {
            display: none;
         }

         .main-content {
            margin-left: 0;
         }

         .nav-link {
            text-align: center;
            padding: 0.5rem;
         }
      }
   </style>
</head>

<body>
   <div class="sidebar">
      <img src="https://cdn-icons-png.flaticon.com/512/1053/1053244.png" alt="Staff Profile">
      <h4><?php echo $_SESSION["staff_name"]; ?></h4>

      <ul class="nav-links">
         <li><a href="staff_dashboard.php" class="nav-link">🏠 Home</a></li>
         <li><a href="staff_check_orders.php" class="nav-link">📦 Check Orders</a></li>
         <li><a href="staff_delivery.php" class="nav-link active">🚚 Deliveries</a></li>
         <li><a href="#" class="nav-link">🔔 Notifications</a></li>
         <li><a href="#" class="nav-link">👤 Account</a></li>
         <li><a href="../auth/php/logout.php" class="nav-link text-danger">🚪 Logout</a></li>
      </ul>
   </div>

   <div class="main-content">
      <h1><i class="bi bi-truck"></i> Deliveries Overview</h1>
      <div id="deliveries"></div>
   </div>

   <script src="../jquery.js"></script>
   <script src="../crud/js/fetch.js"></script>
   <script src="../crud/js/update.js"></script>
   <script src="../crud/js/event_listeners.js"></script>
   <script src="../styles/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>

   <script>
      fetch_deliveries();

      window.addEventListener("pageshow", function (event) {
         if (event.persisted) window.location.reload();
      });
   </script>
</body>
</html>
