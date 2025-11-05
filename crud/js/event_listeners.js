//order button
$(document).on('click', '.order-btn', function() {
   let station_id = $(this).data("station_id");
})

//mode of payment dropdown
$(document).on('change', '#mode-of-payment', function() {
   let mode = $("#mode-of-payment").val();

   if (mode === "cod") {
      $("#e-wallet-number").val("").prop("disabled", true)
   } else {
      $("#e-wallet-number").val(customer_number).prop("disabled", false)
   }
})