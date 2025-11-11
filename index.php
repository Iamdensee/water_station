<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap & Google Fonts -->
    <link rel="stylesheet" href="styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Quicksand:wght@600&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0D1B2A, #1C3FAA);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem 2rem;
            width: 90%;
            max-width: 480px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
            animation: fadeIn 0.7s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h1 {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.2rem;
            color: #1C3FAA;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }

        .login-header p {
            font-size: 0.95rem;
            color: #555;
        }

        .form-label {
            font-weight: 600;
            color: #1C3FAA;
            font-size: 0.9rem;
            text-align: left;
            display: block;
            margin-left: 8%;
            margin-bottom: 0.4rem;
        }

        .form-control,
        .form-select {
            display: block;
            margin: 0 auto;
            border-radius: 12px;
            border: 1.5px solid #ced4da;
            padding: 0.65rem 1rem;
            width: 84%;
            font-size: 0.95rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #1C3FAA;
            box-shadow: 0 0 6px rgba(28, 63, 170, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, #1C3FAA, #2448C0);
            border: none;
            border-radius: 12px;
            width: 84%;
            padding: 0.85rem;
            font-weight: 600;
            margin: 1rem auto 0 auto;
            display: block;
            transition: 0.3s ease;
            letter-spacing: 0.5px;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2448C0, #1C3FAA);
            transform: scale(1.03);
            box-shadow: 0 5px 15px rgba(28, 63, 170, 0.35);
        }

        .signup-link {
            text-align: center;
            margin-top: 1.7rem;
            font-size: 0.9rem;
            color: #555;
        }

        .signup-link a {
            text-decoration: none;
            color: #1C3FAA;
            font-weight: 600;
            transition: 0.3s;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 2rem 1.5rem;
                max-width: 350px;
            }

            .form-control,
            .form-select,
            .btn-primary {
                width: 90%;
            }
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="login-header">
            <h1>Welcome Back</h1>
            <p>Access your water delivery account</p>
        </div>

        <form id="form-login">
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select id="role" class="form-select" required>
                    <option value="selection">- Select A Role -</option>
                    <option value="customer">Customer</option>
                    <option value="staff">Staff</option>
                    <option value="owner">Owner</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <div class="signup-link">
            <p>No account yet? <a href="signup.php">Sign Up Here</a></p>
        </div>
    </div>


</body>

</html>

<script src="styles/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
<script src="jquery.js"></script>
<script src="auth/js/login_user.js"></script>
<script>
    $("#form-login").submit(function (e) {
        e.preventDefault();
        let email = $("#email").val().trim();
        let password = $("#password").val().trim();
        let role = $("#role").val();
        login_user(email, password, role);
    });
</script>