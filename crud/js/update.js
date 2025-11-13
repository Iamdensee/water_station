function mark_as_delivered(delivery_id, order_id) {
    $.post("../crud/php/mark_as_delivered.php", {delivery_id: delivery_id, order_id: order_id}, function(response) {
        if (response === "updated") {
            alert("Order Delivered");
            fetch_deliveries();
        } else {
            alert("Something Went Wrong");
        }
    })
}


function change_price(price) {
    $.post("../crud/php/change_price.php", {price: price}, function(response) {
        if (response === "price changed") {
            alert("Price successfully changed!");
            dashboard_report();
        } else {
            alert(response);
        }
    });
}