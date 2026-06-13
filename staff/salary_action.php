<?php
include("../config/db.php");
session_start();

$action = isset($_GET['action']) ? $_GET['action'] : "";

if ($action == "my_salary") {

    $user_id = $_SESSION['id'];

    $sql = "SELECT * FROM salary
            WHERE user_id='$user_id'
            ORDER BY id DESC";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        echo "
        <tr>
            <td>{$row['month']} {$row['year']}</td>
            <td>{$row['basic_salary']}</td>
            <td>{$row['overtime_pay']}</td>
            <td>{$row['deduction']}</td>
            <td><b>{$row['net_salary']}</b></td>
            <td>{$row['status']}</td>
        </tr>
        ";
    }
}
