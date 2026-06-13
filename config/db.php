<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "factory_erp";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
