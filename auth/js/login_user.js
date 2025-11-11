function login_user(email, password, role) {
    if (role === "customer") {
        $.post("auth/php/login_customer.php", { email: email, password: password }, function (response) {
            if (response === "granted") {
                window.location.href = "templates/customer_dashboard.php";
            } else {
                alert(response);
            }
        });

    } else if (role === "staff") {
        $.post("auth/php/login_staff.php", { email: email, password: password }, function (response) {
            if (response === "granted") {
                window.location.href = "templates/staff_dashboard.php";
            } else {
                alert(response);
            }
        });

    } else if (role === "owner") {
        $.post("auth/php/login_owner.php", { email: email, password: password }, function (response) {
            if (response === "granted") {
                window.location.href = "templates/owner_dashboard.php";
            } else {
                alert(response);
            }
        });

    } else {
        alert("Please select a role");
    }
}