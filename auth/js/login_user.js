function login_user(email, password, role) {
    if (role === "customer") {
        $.post("auth/php/login_customer.php", {email: email, password: password}, function(response) {
            alert(response);
        });

    } else if (role === "staff") {
        $.post("", {email: email, password: password}, function(response) {
            alert(response);
        });

    } else {
        alert("Please select a role");
    }
}