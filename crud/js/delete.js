function fire_staffs(staff_id) {
    if (!confirm("Fire this staff?")) {
        return;
    } else {
        $.post("../crud/php/fire_staffs.php", { staff_id: staff_id }, function (response) {
            if (response === "delete") {
                alert("Staff Fired!");
                fetch_staffs();
            }
        });
    }
}


function decline_staff(application_id, fname, email) {
    $.post("../crud/php/decline_staff.php", { application_id: application_id, fname: fname, email: email }, function (response) {
        if (response === "rejected") {
            alert("Application Rejected!");
            fetch_pending_applications();
        }
    })
}