<?php
include("../config/db.php");
session_start();

$user_id = $_SESSION['id'];
$today = date("Y-m-d");
$now = date("Y-m-d H:i:s");

$office_start = strtotime(date("Y-m-d 09:00:00"));
$current_time = time();

// ================= CHECK-IN =================
if ($_GET['action'] == "checkin") {

    $check = mysqli_query($conn, "SELECT * FROM attendance 
              WHERE user_id='$user_id' AND work_date='$today'");

    if (mysqli_num_rows($check) > 0) {
        echo "Already Checked In";
        exit;
    }

    $late = 0;

    if ($current_time > $office_start) {
        $late = round(($current_time - $office_start) / 60);
    }

    $sql = "INSERT INTO attendance (user_id, check_in, work_date, late_minutes)
            VALUES ('$user_id', '$now', '$today', '$late')";

    echo mysqli_query($conn, $sql) ? "Checked In" : "Error";
}

// ================= CHECK-OUT =================
if ($_GET['action'] == "checkout") {

    $check = mysqli_query($conn, "SELECT * FROM attendance 
              WHERE user_id='$user_id' AND work_date='$today'");

    $row = mysqli_fetch_assoc($check);

    if (!$row) {
        echo "Please Check-In First";
        exit;
    }

    if ($row['check_out'] != NULL) {
        echo "Already Checked Out";
        exit;
    }

    $check_in_time = strtotime($row['check_in']);
    $check_out_time = time();

    // Break = 60 mins
    $worked_seconds = $check_out_time - $check_in_time - (60 * 60);

    $hours = round($worked_seconds / 3600, 2);

    // Overtime logic (after 8 hours)
    $overtime = 0;
    if ($hours > 8) {
        $overtime = ($hours - 8) * 60;
    }

    $sql = "UPDATE attendance SET 
            check_out='$now',
            total_hours='$hours',
            overtime_minutes='$overtime'
            WHERE id='{$row['id']}'";

    echo mysqli_query($conn, $sql) ? "Checked Out" : "Error";
}

// ================= READ =================
if ($_GET['action'] == "read") {

    $sql = "SELECT * FROM attendance 
            WHERE user_id='$user_id' 
            ORDER BY id DESC";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        echo "
        <tr>
            <td>{$row['work_date']}</td>
            <td>{$row['check_in']}</td>
            <td>{$row['check_out']}</td>
            <td>{$row['late_minutes']}</td>
            <td>{$row['overtime_minutes']}</td>
            <td>{$row['total_hours']}</td>
        </tr>
        ";
    }
}
