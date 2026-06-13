<?php
include("includes/auth.php");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-white">

    <div class="container mt-5">
        <h2>Welcome, <?php echo $_SESSION['name']; ?></h2>
        <p>Role: <?php echo $_SESSION['role']; ?></p>

        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

</body>

</html>