<?php
session_start();

if (!isset($_SESSION["customer_id"])) {
   header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Customer Dashboard</title>
   <link rel="stylesheet" href="../styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">

   <!-- Google Fonts -->
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Quicksand:wght@600&display=swap"
      rel="stylesheet">

   <style>
      body {
         min-height: 100vh;
         display: flex;
         background: linear-gradient(135deg, #0D1B2A, #1C3FAA);
         color: #fff;
         font-family: 'Poppins', sans-serif;
         margin: 0;
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
         overflow-y: auto;
      }

      h1 {
         font-family: 'Quicksand', sans-serif;
         font-weight: 600;
         margin-bottom: 2rem;
      }

      .card {
         border: none;
         border-radius: 15px;
         background: rgba(255, 255, 255, 0.15);
         backdrop-filter: blur(10px);
         color: #fff;
         transition: transform 0.25s ease;
      }

      .card:hover {
         transform: translateY(-6px);
      }

      /* Responsiveness */
      @media (max-width: 992px) {
         .sidebar {
            width: 100%;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            padding: 1rem;
         }

         .sidebar img,
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
   <div class="sidebar">
      <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="Profile">
      <h4><?php echo ($_SESSION['customer_name']); ?></h4>

      <ul class="nav-links">
         <li><a href="customer_dashboard.php" class="nav-link active">🏠 Home</a></li>
         <li><a href="customer_order.php" class="nav-link">🛒 Order</a></li>
         <li><a href="customer_check_orders.php" class="nav-link">📦 My Orders</a></li>
         <li><a href="#" class="nav-link">🔔 Notifications</a></li>
         <li><a href="#" class="nav-link">👤 My Account</a></li>
         <li><a href="../auth/php/logout.php" class="nav-link text-danger">🚪 Logout</a></li>
      </ul>
   </div>

   <div class="main-content">
      <h1>Welcome, <?php echo ($_SESSION['customer_name']); ?> 👋</h1>

      <div class="row g-4">
         <div class="col-md-4">
            <div class="card p-4 text-center">
               <h5 class="fw-semibold" style="font-family:'Quicksand', sans-serif;">Recent Orders</h5>
               <p>Track your latest purchases easily.</p>
            </div>
         </div>
         <div class="col-md-4">
            <div class="card p-4 text-center">
               <h5 class="fw-semibold" style="font-family:'Quicksand', sans-serif;">Available Stations</h5>
               <p>Find and explore nearby water stations.</p>
            </div>
         </div>
         <div class="col-md-4">
            <div class="card p-4 text-center">
               <h5 class="fw-semibold" style="font-family:'Quicksand', sans-serif;">Profile Settings</h5>
               <p>Update your account information anytime.</p>
            </div>
         </div>
      </div>
   </div>


</body>

</html>

<script src="../jquery.js"></script>
<script src="../styles/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
<script>
   // Force reload when returning to page
   window.addEventListener("pageshow", function (event) {
      if (event.persisted) window.location.reload();
   });
</script>