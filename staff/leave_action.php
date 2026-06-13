<?php
include("../config/db.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['id'];
$action = $_GET['action'];

// ================= APPLY LEAVE =================
if ($action == "apply") {

    $from = trim($_POST['from_date']);
    $to = trim($_POST['to_date']);
    $reason = trim($_POST['reason']);

    // ❌ BACKEND VALIDATION
    if ($from == "" || $to == "" || $reason == "") {
        echo "All fields are required";
        exit;
    }

    // DATE CHECK
    if ($to < $from) {
        echo "To date must be greater than From date";
        exit;
    }

    $sql = "INSERT INTO leaves 
            (user_id, from_date, to_date, reason, status)
            VALUES 
            ('$user_id', '$from', '$to', '$reason', 'Pending')";

    if (mysqli_query($conn, $sql)) {
        echo "Leave Applied Successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// ================= READ STAFF LEAVES =================
if ($action == "read") {

    $sql = "SELECT * FROM leaves 
            WHERE user_id='$user_id' 
            ORDER BY id DESC";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        echo "
        <tr>
            <td>{$row['from_date']}</td>
            <td>{$row['to_date']}</td>
            <td>{$row['reason']}</td>
            <td>{$row['status']}</td>
        </tr>
        ";
    }
}
