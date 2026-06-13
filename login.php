<?php
include("config/db.php");
session_start();

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
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
    } else {
        $error = "Invalid login details";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Factory ERP Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;

            /* MATCH DASHBOARD THEME */
            background: linear-gradient(-45deg, #0f172a, #1e293b, #0b1220, #111827);
            background-size: 400% 400%;
            animation: bgMove 10s ease infinite;
        }

        /* BACKGROUND ANIMATION */
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

        /* FLOAT SHAPES (UPDATED BLUE THEME) */
        .bg-shapes {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 0;
        }

        /* RECTANGLES */
        .rect,
        .circle {
            position: absolute;
            animation: floatAnim 12s linear infinite;
        }

        /* BLUE RECTANGLES */
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
            background: rgba(30, 41, 59, 0.6);
            border: 2px solid rgba(148, 163, 184, 0.15);
        }

        .rect3 {
            top: 40%;
            left: 80%;
            width: 70px;
            height: 70px;
            background: rgba(59, 130, 246, 0.12);
            border: 2px solid rgba(37, 99, 235, 0.3);
        }

        .rect4 {
            top: 20%;
            left: 60%;
            width: 60px;
            height: 60px;
            background: rgba(29, 78, 216, 0.12);
            border: 2px solid rgba(59, 130, 246, 0.25);
        }

        .rect5 {
            top: 80%;
            left: 70%;
            width: 50px;
            height: 50px;
            background: rgba(15, 23, 42, 0.7);
            border: 2px solid rgba(148, 163, 184, 0.1);
        }

        /* CIRCLES */
        .circle1,
        .circle2,
        .circle3 {
            border-radius: 50%;
        }

        /* BLUE CIRCLES */
        .circle1 {
            top: 15%;
            left: 45%;
            width: 50px;
            height: 50px;
            background: rgba(37, 99, 235, 0.15);
            border: 2px solid rgba(59, 130, 246, 0.3);
        }

        .circle2 {
            top: 60%;
            left: 35%;
            width: 70px;
            height: 70px;
            background: rgba(30, 41, 59, 0.5);
            border: 2px solid rgba(148, 163, 184, 0.15);
        }

        .circle3 {
            top: 75%;
            left: 55%;
            width: 40px;
            height: 40px;
            background: rgba(59, 130, 246, 0.12);
            border: 2px solid rgba(37, 99, 235, 0.3);
        }

        /* FLOAT ANIMATION */
        @keyframes floatAnim {
            0% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-30px) rotate(180deg);
            }

            100% {
                transform: translateY(0px) rotate(360deg);
            }
        }

        /* LOGIN CARD (MATCH ERP STYLE) */
        .login-card {
            width: 100%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(14px);
            border-radius: 14px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            position: relative;
            z-index: 2;
            animation: fadeInUp 0.8s ease;
            color: white;
            border: 1px solid rgba(148, 163, 184, 0.15);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .title {
            text-align: center;
            font-weight: 600;
            margin-bottom: 20px;
            color: #e2e8f0;
        }

        /* INPUT STYLE */
        .form-control {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(148, 163, 184, 0.2);
            color: white;
        }

        .form-control:focus {
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid #3b82f6;
            box-shadow: none;
            color: white;
        }

        /* BUTTON (MATCH DASHBOARD BUTTONS) */
        .btn-login {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border: none;
            transition: 0.3s ease;
            border-radius: 8px;
        }

        .btn-login:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.5);
        }

        a {
            text-decoration: none;
            color: #93c5fd;
        }

        a:hover {
            color: #bfdbfe;
        }
    </style>
</head>

<body>

    <!-- BACKGROUND -->
    <div class="bg-shapes">

        <!-- RECTANGLES -->
        <div class="rect rect1"></div>
        <div class="rect rect2"></div>
        <div class="rect rect3"></div>
        <div class="rect rect4"></div>
        <div class="rect rect5"></div>

        <!-- CIRCLES -->
        <div class="circle circle1"></div>
        <div class="circle circle2"></div>
        <div class="circle circle3"></div>

    </div>

    <!-- LOGIN -->
    <div class="login-card">

        <h3 class="title">Factory ERP Login</h3>

        <form method="POST">

            <?php if (isset($error)) { ?>
                <div class="alert alert-danger py-2">
                    <?php echo $error; ?>
                </div>
            <?php } ?>

            <input type="email" name="email" class="form-control mb-3 p-2" placeholder="Email" required>

            <input type="password" name="password" class="form-control mb-3 p-2" placeholder="Password" required>

            <button type="submit" name="login" class="btn btn-login w-100 text-white">
                Login
            </button>

            <div class="text-center mt-3">
                <a href="register.php" class="text-white">
                    Create Account
                </a>
            </div>

        </form>

    </div>

</body>

</html>