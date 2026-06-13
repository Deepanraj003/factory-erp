<?php
include("config/db.php");
session_start();

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM users 
              WHERE email='$email' 
              AND password='$password'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: staff/dashboard.php");
        }

        exit();
    } else {
        $error = "Invalid Email or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factory ERP Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            background: linear-gradient(-45deg,
                    #0f172a,
                    #1e293b,
                    #0b1220,
                    #111827);
            background-size: 400% 400%;
            animation: bgMove 10s ease infinite;
        }

        @keyframes bgMove {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Background Shapes */
        .bg-shapes {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .shape {
            position: absolute;
            animation: floatAnim 12s linear infinite;
        }

        .rect1 {
            top: 10%;
            left: 15%;
            width: 80px;
            height: 80px;
            background: rgba(37, 99, 235, 0.15);
            border: 2px solid rgba(59, 130, 246, 0.35);
        }

        .rect2 {
            top: 70%;
            left: 10%;
            width: 90px;
            height: 90px;
            background: rgba(30, 41, 59, 0.5);
            border: 2px solid rgba(148, 163, 184, 0.15);
        }

        .rect3 {
            top: 35%;
            right: 10%;
            width: 70px;
            height: 70px;
            background: rgba(59, 130, 246, 0.12);
            border: 2px solid rgba(37, 99, 235, 0.3);
        }

        .circle1,
        .circle2,
        .circle3 {
            border-radius: 50%;
        }

        .circle1 {
            top: 20%;
            left: 60%;
            width: 55px;
            height: 55px;
            background: rgba(59, 130, 246, 0.12);
            border: 2px solid rgba(59, 130, 246, 0.3);
        }

        .circle2 {
            bottom: 15%;
            right: 20%;
            width: 70px;
            height: 70px;
            background: rgba(30, 41, 59, 0.6);
            border: 2px solid rgba(148, 163, 184, 0.2);
        }

        .circle3 {
            top: 60%;
            left: 35%;
            width: 45px;
            height: 45px;
            background: rgba(37, 99, 235, 0.15);
            border: 2px solid rgba(59, 130, 246, 0.35);
        }

        @keyframes floatAnim {
            0% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-30px) rotate(180deg);
            }

            100% {
                transform: translateY(0) rotate(360deg);
            }
        }

        /* Login Card */
        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 35px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(148, 163, 184, 0.15);
            z-index: 10;
            position: relative;
            color: white;
            animation: fadeUp 0.8s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .title {
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            color: #f8fafc;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            color: #94a3b8;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .form-control {
            background: rgba(15, 23, 42, 0.65);
            border: 1px solid rgba(148, 163, 184, 0.25);
            color: white !important;
            padding: 14px;
            border-radius: 10px;
        }

        .form-control:focus {
            background: rgba(15, 23, 42, 0.85);
            border-color: #3b82f6;
            box-shadow: 0 0 12px rgba(59, 130, 246, 0.25);
            color: white;
        }

        /* Placeholder Fix */
        .form-control::placeholder {
            color: #cbd5e1 !important;
            opacity: 1;
        }

        .btn-login {
            background: linear-gradient(135deg,
                    #2563eb,
                    #1d4ed8);
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            transition: .3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 18px rgba(59, 130, 246, 0.45);
        }

        .register-link {
            text-align: center;
            margin-top: 18px;
        }

        .register-link a {
            color: #93c5fd;
            text-decoration: none;
            font-weight: 500;
        }

        .register-link a:hover {
            color: #dbeafe;
        }
    </style>
</head>

<body>

    <!-- Floating Background -->
    <div class="bg-shapes">
        <div class="shape rect1"></div>
        <div class="shape rect2"></div>
        <div class="shape rect3"></div>

        <div class="shape circle1"></div>
        <div class="shape circle2"></div>
        <div class="shape circle3"></div>
    </div>

    <!-- Login Card -->
    <div class="login-card">

        <h2 class="title">Factory ERP</h2>
        <p class="subtitle">Login To Continue</p>

        <form method="POST">

            <?php if (isset($error)) { ?>
                <div class="alert alert-danger text-center">
                    <?php echo $error; ?>
                </div>
            <?php } ?>

            <input type="email"
                name="email"
                class="form-control mb-3"
                placeholder="Enter Email Address"
                required>

            <input type="password"
                name="password"
                class="form-control mb-3"
                placeholder="Enter Password"
                required>

            <button type="submit"
                name="login"
                class="btn btn-login w-100 text-white">
                Login
            </button>

            <div class="register-link">
                <a href="register.php">
                    Create New Account
                </a>
            </div>

        </form>

    </div>

</body>

</html>