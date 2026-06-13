<?php
include("config/db.php");
session_start();

if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $role = "staff";

    $sql = "INSERT INTO users (name, email, password, role)
            VALUES ('$name', '$email', '$password', '$role')";

    if (mysqli_query($conn, $sql)) {
        header("Location: login.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Factory ERP Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ===== MATCH LOGIN THEME ===== */
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;

            background: linear-gradient(-45deg,
                    #0f172a, #1e293b, #0b1220, #111827);
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

        /* FLOAT BACKGROUND */
        .bg-shapes {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
        }

        .rect,
        .circle {
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

        .circle1 {
            top: 15%;
            left: 45%;
            width: 50px;
            height: 50px;
            background: rgba(37, 99, 235, 0.15);
            border: 2px solid rgba(59, 130, 246, 0.3);
            border-radius: 50%;
        }

        .circle2 {
            top: 60%;
            left: 35%;
            width: 70px;
            height: 70px;
            background: rgba(30, 41, 59, 0.5);
            border: 2px solid rgba(148, 163, 184, 0.15);
            border-radius: 50%;
        }

        .circle3 {
            top: 75%;
            left: 55%;
            width: 40px;
            height: 40px;
            background: rgba(59, 130, 246, 0.12);
            border: 2px solid rgba(37, 99, 235, 0.3);
            border-radius: 50%;
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

        /* REGISTER CARD */
        .register-card {
            width: 100%;
            max-width: 420px;
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(14px);
            border-radius: 14px;
            padding: 30px;
            z-index: 2;
            position: relative;
            color: white;
            border: 1px solid rgba(148, 163, 184, 0.15);
            animation: fadeInUp 0.8s ease;
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
            margin-bottom: 20px;
            color: #e2e8f0;
            font-weight: 600;
        }

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

        .btn-register {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border: none;
            transition: 0.3s;
        }

        .btn-register:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.5);
        }

        a {
            color: #93c5fd;
            text-decoration: none;
        }

        a:hover {
            color: #bfdbfe;
        }
    </style>
</head>

<body>

    <!-- BACKGROUND SHAPES -->
    <div class="bg-shapes">
        <div class="rect rect1"></div>
        <div class="rect rect2"></div>
        <div class="rect rect3"></div>
        <div class="rect rect4"></div>
        <div class="rect rect5"></div>

        <div class="circle circle1"></div>
        <div class="circle circle2"></div>
        <div class="circle circle3"></div>
    </div>

    <!-- REGISTER CARD -->
    <div class="register-card">
        <h3 class="title">Factory ERP Register</h3>

        <form method="POST">
            <input type="text" name="name" class="form-control mb-3 p-2" placeholder="Name" required>
            <input type="email" name="email" class="form-control mb-3 p-2" placeholder="Email" required>
            <input type="password" name="password" class="form-control mb-3 p-2" placeholder="Password" required>

            <button type="submit" name="register" class="btn btn-register w-100 text-white">
                Register
            </button>

            <div class="text-center mt-3">
                <a href="login.php">Already have account? Login</a>
            </div>
        </form>
    </div>

</body>

</html>