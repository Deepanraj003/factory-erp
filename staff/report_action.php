<?php
include("../config/db.php");
session_start();

$user_id = $_SESSION['id'];
$today = date("Y-m-d");

$action = $_GET['action'];

// ================= ADD REPORT =================
if ($action == "add") {

    $title = $_POST['title'];
    $desc = $_POST['description'];

    $sql = "INSERT INTO daily_reports (user_id, work_date, title, description)
            VALUES ('$user_id','$today','$title','$desc')";

    echo mysqli_query($conn, $sql) ? "Report Submitted" : "Error";
}

// ================= READ REPORT =================
if ($action == "read") {

    $sql = "SELECT * FROM daily_reports 
            WHERE user_id='$user_id'
            ORDER BY id DESC";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        echo "
        <tr>
            <td>{$row['work_date']}</td>
            <td>{$row['title']}</td>
            <td>{$row['description']}</td>
        </tr>
        ";
    }
}
