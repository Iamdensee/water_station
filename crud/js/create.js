function add_orders(station_id, quantity, address) {

   $.post("../crud/php/add_order.php",
      {
         station_id: station_id,
         quantity: quantity,
         address: address,

      }, function (response) {
         if (response === "success") {
            window.location.href = "customer_check_orders.php";
         } else {
            alert(response);
         };
      })

}

function checkout_order(order_id, payment_method, contact, e_wallet) {
   if (payment_method === "COD") {
      $.post("../crud/php/checkout_order_cod.php",
         {
            order_id: order_id,
            payment_method: payment_method,
            contact: contact,

         }, function (response) {
            alert(response);
         })

   } else if (payment_method === "Gcash") {
      $.post("../crud/php/checkout_order_gcash.php",
         {
            order_id: order_id,
            payment_method: payment_method,
            contact: contact,
            e_wallet: e_wallet,

         }, function (response) {
            alert(response);
         })
   } else {
      alert("Select payment method");
   }

}