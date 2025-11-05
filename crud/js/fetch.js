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
                     <p>⏳ Status: ${orders.status}</p>
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
         if (orders.status === "Pending" || orders.status === "Out for Delivery") {
            $(`.checkout-btn[data-order-id='${orders.order_id}']`).prop("disabled", true);
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
                     <p><strong>Status:</strong> <span class="order-status status-pending">${pending_orders.status}</span></p>
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
   $.get("", function(response) {
      alert(response);
   })
}