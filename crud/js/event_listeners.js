//order button
$(document).on('click', '.order-btn', function () {
   let station_id = $("#station_id").val($(this).data("station-id"));
   let station_name = $(this).data("station-name");
   let price = $(this).data("price");
   
   let station_name_placeholder = $("#station-name-placeholder");
   let total_price_placeholder = $("#total-price-placeholder");
   station_name_placeholder.html('<strong>Station: </strong>' + station_name);

   $(document).on('keyup', '#quantity', function () {
      let quantity = $("#quantity").val();
      total_price_placeholder.html('<strong>Total Price: </strong>' + '₱' + price * quantity);
   });

   $(document).on('click', '#quantity', function () {
      let quantity = $("#quantity").val();
      total_price_placeholder.html('<strong>Total Price: </strong>' + '₱' + price * quantity);
   }); 


});

//checkout button
$(document).on('click', '.checkout-btn', function() {
   $("#order-id").val($(this).data("order-id"));
});

//mode of payment dropdown
$(document).on('change', '#payment-method', function () {
   if ($(this).val() === 'Gcash') {
      $('#e-wallet-section').slideDown(200);
      $('#e-wallet-number').prop('disabled', false);
   } else {
      $('#e-wallet-section').slideUp(200);
      $('#e-wallet-number').prop('disabled', true);
   }
});


//deliver button
$(document).on('click', '.deliver-btn', function() {
   let order_id = $(this).data("order-id");

   add_delivery(order_id);
});


//mark as delivered button
$(document).on('click', '.mark-delivered-btn', function() {
   let delivery_id = $(this).data("delivery-id");
   let order_id = $(this).data("order-id");

   mark_as_delivered(delivery_id, order_id);
});