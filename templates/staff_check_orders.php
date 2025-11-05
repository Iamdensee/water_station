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
   <title>Check Orders</title>
   <link rel="stylesheet" href="../styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">

   <!-- Google Fonts -->
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Quicksand:wght@600&display=swap" rel="stylesheet">

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
      }

      /* Order list cards */
      ul#orders {
         list-style: none;
         padding: 0;
         margin: 0;
      }

      ul#orders li {
         background: rgba(255, 255, 255, 0.12);
         border-radius: 15px;
         padding: 1.5rem;
         margin-bottom: 1rem;
         backdrop-filter: blur(12px);
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
         display: flex;
         justify-content: space-between;
         align-items: center;
         flex-wrap: wrap;
         transition: transform 0.3s ease, background 0.3s ease;
      }

      ul#orders li:hover {
         background: rgba(255, 255, 255, 0.2);
         transform: translateY(-4px);
      }

      .order-info {
         flex: 1;
         margin-right: 1rem;
      }

      /* Compact details */
      .order-info p {
         margin: 0;
         font-size: 0.95rem;
      }

      .order-info p + p {
         margin-top: 2px;
      }

      /* Add more space only before the status line */
      .order-info p:last-of-type {
         margin-top: 10px;
      }

      .order-status {
         font-weight: 600;
         text-transform: capitalize;
      }

      /* Status colors */
      .status-pending { color: #ffcc00; }
      .status-processing { color: #00bfff; }
      .status-delivered { color: #00b67a; }
      .status-cancelled { color: #ff4d4d; }

      .action-btns button {
         margin: 0.25rem;
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
      <h4><?php echo htmlspecialchars($_SESSION["staff_name"]); ?></h4>

      <ul class="nav-links">
         <li><a href="staff_dashboard.php" class="nav-link">🏠 Home</a></li>
         <li><a href="staff_check_orders.php" class="nav-link active">📦 Check Orders</a></li>
         <li><a href="staff_delivery.php" class="nav-link">🚚 Deliveries</a></li>
         <li><a href="#" class="nav-link">🔔 Notifications</a></li>
         <li><a href="#" class="nav-link">👤 Account</a></li>
         <li><a href="../auth/php/logout.php" class="nav-link text-danger">🚪 Logout</a></li>
      </ul>
   </div>

   <div class="main-content">
      <h1>📋 Check Pending Orders</h1>
      <ul id="orders"></ul>
   </div>
</body>
</html>

<script src="../jquery.js"></script>
<script src="../crud/js/create.js"></script>
<script src="../crud/js/fetch.js"></script>
<script src="../crud/js/event_listeners.js"></script>
<script src="../styles/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
<script>
   fetch_pending_orders();

   // Force reload when returning to page
   window.addEventListener("pageshow", function (event) {
      if (event.persisted) window.location.reload();
   });
</script>
