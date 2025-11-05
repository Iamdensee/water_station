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
                  data-station_id="${stations.station_id}">
                     Order
                  </button>
               </li>`;
            });

            station_placeholder.html(display_station);
         });
      }