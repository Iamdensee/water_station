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
   <title>My Orders</title>
   <link rel="stylesheet" href="../styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">
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

      /* Order Card Styling */
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
         color: #fff;
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
         transition: transform 0.3s ease, background 0.3s ease;
      }

      ul#orders li:hover {
         background: rgba(255, 255, 255, 0.2);
         transform: translateY(-5px);
      }

      .order-header {
         display: flex;
         justify-content: space-between;
         align-items: center;
         margin-bottom: 0.5rem;
      }

      .order-header strong {
         font-family: 'Quicksand', sans-serif;
         font-size: 1.2rem;
      }

      .order-status {
         font-weight: 600;
         text-transform: capitalize;
         font-size: 1rem;
      }

      .status-pending {
         color: #ffcc00;
      }

      .status-completed {
         color: #00b67a;
      }

      .status-cancelled {
         color: #ff4d4d;
      }

      .divider {
         height: 2px;
         background-color: rgba(255, 255, 255, 0.2);
         margin: 0.5rem 0 1rem;
      }

      .order-body p {
         margin: 0.25rem 0;
         font-size: 0.95rem;
      }

      .order-body button {
         margin-top: 1rem;
      }

      @media (max-width: 992px) {
         .sidebar {
            width: 100%;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            padding: 1rem;
            height: auto;
            position: relative;
         }

         .sidebar img,
         .sidebar h4 {
            display: none;
         }

         .main-content {
            margin-left: 0;
            padding-top: 1rem;
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
     <li><a href="customer_order.php" class="nav-link">🛒 Order</a></li>
     <li><a href="customer_check_orders.php" class="nav-link active">📦 My Orders</a></li>
     <li><a href="#" class="nav-link">🔔 Notifications</a></li>
     <li><a href="#" class="nav-link">👤 My Account</a></li>
     <li><a href="../auth/php/logout.php" class="nav-link text-danger">🚪 Logout</a></li>
  </ul>

   </div>

   <div class="main-content">
      <h1>📦 My Orders</h1>
      <ul id="orders"></ul>
   </div>

   <!-- Checkout Modal -->

   <div class="modal fade" id="checkout_order" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered">
         <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
            <div class="modal-header bg-primary text-white">
               <h5 class="modal-title">🧾 Confirm Order</h5>
               <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

        <div class="modal-body bg-light text-dark">
           <form id="form-checkout-order" class="d-flex flex-column gap-3">
              <input type="text" id="order-id" hidden>

              <div>
                 <label for="payment-method" class="form-label fw-semibold">Payment Method</label>
                 <select id="payment-method" class="form-select" required>
                    <option value="">-- Select Mode of Payment --</option>
                    <option value="Gcash">Gcash</option>
                    <option value="COD">Cash on Delivery</option>
                 </select>
              </div>

              <div>
                 <label for="contact-number" class="form-label fw-semibold">Contact Number</label>
                 <input type="text" id="contact-number" class="form-control" placeholder="09xxxxxxxxx"
                    pattern="^09\d{9}$" value="<?php echo $_SESSION['customer_number']; ?>" required>
              </div>

              <div id="e-wallet-section" style="display: none;">
                 <label for="e-wallet-number" class="form-label fw-semibold">E-Wallet Number</label>
                 <input type="text" id="e-wallet-number" class="form-control" placeholder="09xxxxxxxxx"
                    pattern="^09\d{9}$" value="<?php echo $_SESSION['customer_number']; ?>">
              </div>

              <div class="text-center mt-3">
                 <button type="submit" class="btn btn-outline-success px-4 fw-semibold">
                    🛒 Place Order
                 </button>
              </div>
           </form>
        </div>
     </div>
  </div>

   </div>

   <script src="../jquery.js"></script>

   <script src="../crud/js/create.js"></script>

   <script src="../crud/js/fetch.js"></script>

   <script src="../crud/js/event_listeners.js"></script>

   <script src="../styles/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>

   <script>
      let customer_number = '<?php echo $_SESSION["customer_number"] ?>';

      $("#form-checkout-order").submit(function (e) {
         e.preventDefault();
         let order_id = $("#order-id").val().trim();
         let payment_method = $("#payment-method").val().trim();
         let contact = $("#contact-number").val().trim();
         let e_wallet = $("#e-wallet-number").val().trim();
         checkout_order(order_id, payment_method, contact, e_wallet);
      });

      fetch_customer_orders();

      window.addEventListener("pageshow", function (event) {
         if (event.persisted) window.location.reload();
      });
   </script>

</body>

</html>
