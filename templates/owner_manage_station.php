<?php
session_start();
if (!isset($_SESSION["owner_id"])) {
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Station</title>
    <link rel="stylesheet" href="../styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">
</head>

<body>

    <a href="owner_dashboard.php"> Home </a>
    <a href="owner_manage_station.php"> Manage Station </a>
    <a href=""> Manage Staffs </a>
    <a href="owner_view_orders.php"> View Orders </a>
    <a href=""> View Deliveries </a>
    <a href="../auth/php/logout.php"> Logout </a>

    <div>
        <h4> Remaining Stocks: </h4>
        <p id="stocks-placeholder"></p>
    </div>

    <div>
        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#add_stocks"> Add/Edit Stocks
        </button>

    </div>

    <div>
        <h4> Price per galloon: </h4>
        <p id="price-placeholder"></p>
    </div>

    <div>
        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#change_price"> Change price
        </button>

    </div>

    <div class="modal fade" id="add_stocks" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"> Add Stocks </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-dark bg-light">
                    <h6 class="fw-semibold mb-3 text-center" id="station-name-placeholder">Add Stocks</h6>
                    <form id="frm-add-stocks">
                        <input type="number" placeholder="Quantity" id="add-stocks" required>
                        <button type="submit" class="btn btn-outline-dark"> Confirm </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="change_price" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"> Change Price </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-dark bg-light">
                    <h6 class="fw-semibold mb-3 text-center" id="station-name-placeholder">Change Unit Price</h6>
                    <form id="frm-change-price">
                        <input type="number" placeholder="Price" id="change-price" required>
                        <button type="submit" class="btn btn-outline-success"> Save </button>
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
<script src="../crud/js/update.js"></script>
<script src="../styles/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
<script>
    $("#frm-add-stocks").submit(function(e) {
        e.preventDefault();

        let quantity = $("#add-stocks").val().trim();
        add_stocks(quantity);
    }) 


    $("#frm-change-price").submit(function(e) {
        e.preventDefault();

        let price = $("#change-price").val().trim();
        change_price(price);
    }) 

    dashboard_report();

    window.addEventListener("pageshow", function (event) {
        if (event.persisted) window.location.reload();
    });
</script>