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
   <title>Order Page</title>
   <link rel="stylesheet" href="../styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">

   <!-- Google Fonts (Same as Login & Signup) -->
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

      /* Station List */
      ul#stations {
         list-style: none;
         padding: 0;
         margin: 0;
      }

      ul#stations li {
         background: rgba(255, 255, 255, 0.12);
         border-radius: 15px;
         padding: 1.5rem;
         margin-bottom: 1rem;
         backdrop-filter: blur(12px);
         color: #fff;
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
         transition: transform 0.3s ease, background 0.3s ease;
         display: flex;
         justify-content: space-between;
         align-items: center;
         flex-wrap: wrap;
      }

      ul#stations li:hover {
         background: rgba(255, 255, 255, 0.2);
         transform: translateY(-5px);
      }

      .station-info {
         flex: 1;
      }

      .station-info strong {
         font-family: 'Quicksand', sans-serif;
         font-size: 1.2rem;
         display: block;
         margin-bottom: 0.3rem;
      }

      .station-info p {
         margin: 0.2rem 0;
         font-size: 0.95rem;
      }

      .order-btn {
         font-weight: 600;
         border-radius: 10px;
         padding: 0.6rem 1.5rem;
         color: #fff !important;
         border: 2px solid #00b67a;
         background: transparent;
         transition: all 0.3s ease;
      }

      .order-btn:hover {
         background-color: #00b67a;
         color: #fff !important;
         transform: scale(1.05);
         box-shadow: 0 0 10px rgba(0, 255, 160, 0.5);
      }

      @media (max-width: 768px) {
         ul#stations li {
            flex-direction: column;
            align-items: flex-start;
         }

         .order-btn {
            width: 100%;
            margin-top: 1rem;
         }
      }

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
         <li><a href="customer_dashboard.php" class="nav-link">🏠 Home</a></li>
         <li><a href="customer_order.php" class="nav-link active">🛒 Order</a></li>
         <li><a href="customer_check_orders.php" class="nav-link">📦 My Orders</a></li>
         <li><a href="#" class="nav-link">🔔 Notifications</a></li>
         <li><a href="#" class="nav-link">👤 My Account</a></li>
         <li><a href="../auth/php/logout.php" class="nav-link text-danger">🚪 Logout</a></li>
      </ul>
   </div>

   <div class="main-content">
      <h1>Available Water Stations 💧</h1>
      <ul id="stations"></ul>
   </div>

   <div class="modal fade" id="customer_order" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered">
         <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
            <div class="modal-header bg-primary text-white">
               <h5 class="modal-title">🛒 Place Your Order</h5>
               <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-dark bg-light">
               <h6 class="fw-semibold mb-3 text-center" id="station-name-placeholder">Water Station Name</h6>

               <form id="form-add-order" class="d-flex flex-column gap-3">
                  <input type="hidden" id="station_id">

                  <div>
                     <label for="quantity" class="form-label mb-1 fw-medium">Quantity (Gallons)</label>
                     <input type="number" class="form-control" id="quantity" min="1" placeholder="Enter quantity"
                        required>
                  </div>

                  <div>
                     <label for="address" class="form-label mb-1 fw-medium">Delivery Address</label>
                     <input type="text" class="form-control" id="address"
                        value="<?php echo $_SESSION['customer_address']; ?>" required>
                  </div>

                  <p id="total-price-placeholder" class="mt-2 text-center fw-semibold text-success">
                     Total Price: ₱0
                  </p>

                  <div class="text-center mt-3">
                     <button type="submit" class="btn btn-outline-success px-4 fw-semibold">Confirm Order</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>


</body>

</html>

<script src="../jquery.js"></script>
<script src="../crud/js/create.js"></script>
<script src="../crud/js/fetch.js"></script>
<script src="../styles/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
<script>
   let customer_number = '<?php echo $_SESSION["customer_number"] ?>';
   fetch_stations();

   $("#form-add-order").submit(function (e) {
      e.preventDefault();

      let station_id = $("#station_id").val();
      let quantity = $("#quantity").val().trim();
      let address = $("#address").val().trim();

      add_orders(station_id, quantity, address);
   })

   window.addEventListener("pageshow", function (event) {
      if (event.persisted) window.location.reload();
   });
</script>