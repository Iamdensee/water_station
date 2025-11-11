//display and order from stations
function fetch_stations() {
   $.get("../crud/php/fetch_stations.php", function (response) {
      let station = JSON.parse(response);
      let station_placeholder = $("#stations");
      let display_station = "";

      station.forEach((stations) => {
         display_station += `
               <li>
                  <div class="station-info">
                     <strong>${stations.station_name}</strong>
                     <p>🧃 Available Stocks: <b>${stations.stocks}</b></p>
                     <p>💰 Price per Unit: ₱${stations.price_per_unit}</p>
                  </div>
                  <button class="btn order-btn btn-outline-success" 
                  data-bs-toggle="modal" 
                  data-bs-target="#customer_order" 
                  data-station-id="${stations.station_id}"
                  data-station-name="${stations.station_name}"
                  data-price="${stations.price_per_unit}">
                     🛒Order
                  </button>
               </li>`;
      });

      station_placeholder.html(display_station);
   });
}


function fetch_customer_orders() {
   $.get("../crud/php/fetch_customer_orders.php", function (response) {
      let order = JSON.parse(response);
      let list = "";

      if (order.length === 0) {
         list = `<p class='text-center text-light'>You have no orders yet.</p>`;
      } else {
         order.forEach(orders => {
            list += `
               <li>
                  <div class="order-info">
                     <strong>${orders.station_name}</strong>
                     <p>💰 Price per unit: ₱${orders.price_per_unit}</p>
                     <p>🧃 Quantity: <b>${orders.quantity}</b></p>
                     <p>💰 Total Price: ₱${orders.price_per_unit * orders.quantity}</p>
                     <p>📅 Date and Time Ordered: ${orders.date_time_ordered}</p>
                     <p>⏳ Status: ${orders.order_status}</p>
                     <button class="btn btn-outline-success text-white checkout-btn" 
                        data-bs-toggle="modal" 
                        data-bs-target="#checkout_order"
                        data-order-id="${orders.order_id}"> 🛒 Check Out </button>
                     <button class="btn btn-outline-danger text-white cancel-btn"
                        data-order-id="${orders.order_id}"> ❌ Cancel </button>
                  </div>
               </li>`;
         });
      }

      $("#orders").html(list);

      order.forEach(orders => {
         if (orders.order_status === "Pending" || orders.order_status === "Out for Delivery" || orders.order_status === "Delivered") {
            $(`.checkout-btn[data-order-id='${orders.order_id}']`).prop("disabled", true);
            if (orders.order_status === "Delivered") {
               $(`.cancel-btn[data-order-id='${orders.order_id}']`).prop("disabled", true);
            } else {
               $(`.cancel-btn[data-order-id='${orders.order_id}']`).prop("disabled", false);
            }
         }
      });
   });
}


function fetch_pending_orders() {
   $.get("../crud/php/fetch_pending_orders.php", function (response) {
      let pending_order = JSON.parse(response);
      let pending_list = "";

      if (pending_order.length > 0) {
         pending_order.forEach(pending_orders => {
            pending_list += `
               <li>
                  <div class="order-info">
                     <h3><strong>Order:</strong> ${pending_orders.order_id}</h3>
                     <p><strong>Customer:</strong> ${pending_orders.customer_name}</p>
                     <p><strong>Address:</strong> ${pending_orders.address}</p>
                     <p><strong>Total Price:</strong> ₱${pending_orders.total_amount}</p>
                     <p><strong>Payment Method:</strong> ${pending_orders.payment_method}</p>
                     <p><strong>Status:</strong> <span class="order-status status-pending">${pending_orders.order_status}</span></p>
                  </div>
                  <div class="action-btns">
                     <button class="btn btn-success btn-md deliver-btn" data-order-id="${pending_orders.order_id}">Deliver</button>
                  </div>
               </li>`;
         });

         $("#orders").html(pending_list);
      } else {
         pending_list = `<li>
            <div class="order-info">
               No more pending orders
            </div>
         </li>`
         $("#orders").html(pending_list);
      }

   });
}


function fetch_deliveries() {
   $.get("../crud/php/fetch_delivery.php", function (response) {
      let delivery = JSON.parse(response);
      let delivery_list = "";

      if (delivery.length > 0) {
         let delivery_list = "";
         delivery.forEach(deliveries => {
            let statusIcon = "";
            let statusClass = deliveries.delivery_status.toLowerCase();

            // Pick icon depending on status
            if (statusClass === "pending") statusIcon = `<i class="bi bi-hourglass-split text-warning"></i>`;
            else if (statusClass === "approved") statusIcon = `<i class="bi bi-check-circle text-info"></i>`;
            else if (statusClass === "delivered") statusIcon = `<i class="bi bi-truck text-success"></i>`;
            else if (statusClass === "cancelled") statusIcon = `<i class="bi bi-x-circle text-danger"></i>`;

            delivery_list += `
         <div class="delivery-card">
            <div class="delivery-header">
               <h5><i class="bi bi-box-seam"></i> Order #${deliveries.order_id}</h5>
               <span class="delivery-status status-${statusClass}">
                  ${statusIcon} ${deliveries.delivery_status}
               </span>
            </div>
            <div class="delivery-info">
               <p><strong>Customer:</strong> ${deliveries.customer_name}</p>
               <p><strong>Address:</strong> ${deliveries.delivery_address}</p>
               <p><strong>Total Price:</strong> ₱${deliveries.total_amount}</p>
               <p><strong>Payment Method:</strong> ${deliveries.payment_method}</p>
            </div>
            <div class="action-btns">
               <button class="btn btn-success btn-sm mark-delivered-btn" 
                  data-delivery-id="${deliveries.delivery_id}" 
                  data-order-id="${deliveries.order_id}">
                  <i class="bi bi-check2-circle"></i> Mark as Delivered
               </button>
            </div>
         </div>`;
         });
         $("#deliveries").html(delivery_list);

         delivery.forEach(deliveries => {
            if (deliveries.delivery_status === "Delivered") {
               $(`.mark-delivered-btn[data-delivery-id='${deliveries.delivery_id}']`).prop("disabled", true);
            }
         });

      } else {
         delivery_list =
            `<li>
               <div class="delivery-card">
                  No ongoing deliveries
               </div>
            </li>`
         $("#deliveries").html(delivery_list);
      }

   })
}


function dashboard_report() {
   //revenue report
   $.get("../crud/php/daily_revenue.php", function (response) {
      if (response === "no rows") {
         $("#revenue-placeholder").html("No sales yet");
      } else {
         let daily_revenue = JSON.parse(response);
         $("#revenue-placeholder").html(`₱${daily_revenue.total_revenue}`);
      }

   });

   // //stocks report
   $.get("../crud/php/station_stocks.php", function (response) {
      let stocks = JSON.parse(response);
      $("#stocks-placeholder").html(`${stocks.stocks} stocks left`)
   });

   // //ongoing deliveries report
   $.get("../crud/php/ongoing_deliveries.php", function (response) {
      if (response === "no rows") {
         $("#ongoing-deliveries-placeholder").html("No ongoing deliveries yet");
      } else {
         let ongoing_deliveries = JSON.parse(response);
         $("#ongoing-deliveries-placeholder").html(ongoing_deliveries.length);
      }


   });

   //delivered galloons report
   $.get("../crud/php/delivered_galloons.php", function(response) {
      if (response === "no rows") {
         $("#delivered-placeholder").html("No delivered galloons yet");
      } else {
         let delivered = JSON.parse(response);
         $("#delivered-placeholder").html(delivered.length);
      }
   });

   // //pending orders report
   // $.get("../", function(response) {
   //    alert(response);
   // });
}