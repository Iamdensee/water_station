<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form id="form-login">
        <input type="email" placeholder="email" id="email">
        <input type="password" placeholder="password" id="password">
        <select name="" id="role">
            <option value="selection"> - Select A Role - </option>
            <option value="customer"> Customer </option>
            <option value="staff"> Staff </option>
        </select>
        <button type="submit"> Login </button>
    </form>

    <a href="signup.html"> Sign Up Here </a>
</body>
</html>

<script src="jquery.js"></script>
<script src="auth/js/login_user.js"></script>
<script>
    $("#form-login").submit(function(e) {
        e.preventDefault();
        let email = $("#email").val().trim();
        let password = $("#password").val().trim();
        let role = $("#role").val();

        login_user(email, password, role);
    }) 
</script>