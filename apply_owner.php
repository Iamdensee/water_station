<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Application</title>

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

        .signup-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem 2rem;
            width: 90%;
            max-width: 520px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
            animation: fadeIn 0.7s ease;
            overflow-y: auto;
            max-height: 90vh;
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

        .signup-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .signup-header h1 {
            font-family: 'Quicksand', sans-serif;
            font-size: 2.2rem;
            color: #1C3FAA;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }

        .signup-header p {
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

        .form-control {
            display: block;
            margin: 0 auto;
            border-radius: 12px;
            border: 1.5px solid #ced4da;
            padding: 0.65rem 1rem;
            width: 84%;
            font-size: 0.95rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
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

        .login-link {
            text-align: center;
            margin-top: 1.7rem;
            font-size: 0.9rem;
            color: #555;
        }

        .login-link a {
            text-decoration: none;
            color: #1C3FAA;
            font-weight: 600;
            transition: 0.3s;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .signup-card {
                padding: 2rem 1.2rem;
                max-width: 350px;
            }

            .form-control,
            .btn-primary {
                width: 90%;
            }
        }
    </style>
</head>

<body>

        

    <div class="signup-card">
        <div class="signup-header">
            <h1>Apply as an Owner</h1>
            <p>Join our water delivery service</p>
        </div>

        <form id="form-apply-owner">
            <div class="mb-3">
                <label for="first-name" class="form-label">First Name</label>
                <input type="text" id="first-name" class="form-control" placeholder="Enter your first name" required>
            </div>

            <div class="mb-3">
                <label for="middle-name" class="form-label">Middle Name</label>
                <input type="text" id="middle-name" class="form-control" placeholder="Enter your middle name" required>
            </div>

            <div class="mb-3">
                <label for="last-name" class="form-label">Last Name</label>
                <input type="text" id="last-name" class="form-control" placeholder="Enter your last name" required>
            </div>

            <div class="mb-3">
                <label for="contact-number" class="form-label">Contact Number</label>
                <input type="text" id="contact-number" class="form-control" placeholder="09XXXXXXXXX"
                    pattern="^09\d{9}$" maxlength="11" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
                <label for="station" class="form-label">Station Name</label>
                <input type="text" id="station" class="form-control" placeholder="Station Name" required>
            </div>

            <button type="submit" class="btn btn-primary">Apply</button>
        </form>

        <div class="login-link">
            <p>Already have an account? <a href="index.php">Login Here</a></p>
        </div>
    </div>


</body>

</html>

<script src="styles/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
<script src="jquery.js"></script>
<script src="crud/js/create.js"></script>
<script>
    $("#form-apply-owner").submit(function (e) {
        e.preventDefault();
        let fname = $("#first-name").val().trim();
        let mname = $("#middle-name").val().trim();
        let lname = $("#last-name").val().trim();
        let contact_number = $("#contact-number").val().trim();
        let email = $("#email").val().trim();
        let station = $("#station").val().trim();

        apply_owner(fname, mname, lname, contact_number, email, station);
    });
</script>