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


//fire button
$(document).on('click', '.fire-btn', function() {
   let staff_id = $(this).data("staff-id");

   fire_staffs(staff_id);
})


//accept staff application
$(document).on('click', '.approve-staff-btn', function() {
   let application = $(this).data("application-id");
   let first_name = $(this).data("first-name");
   let middle_name = $(this).data("middle-name");
   let last_name = $(this).data("last-name");
   let contact_number = $(this).data("contact-number");
   let email = $(this).data("email");
   let station_id = $(this).data("station-id");

   approve_staff(application, first_name, middle_name, last_name, contact_number, email, station_id);
})


//decline staff application
$(document).on('click', '.decline-staff-btn', function() {
   let application_id = $(this).data("application-id");
   let fname = $(this).data("first-name");
   let email = $(this).data("email");

   decline_staff(application_id, fname, email);
});