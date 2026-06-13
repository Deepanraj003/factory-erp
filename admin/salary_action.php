<?php
include("../config/db.php");

$action = $_GET['action'];
$month = date("F");
$year = date("Y");

// ================= GENERATE SALARY =================
if ($action == "generate") {

    $users = mysqli_query($conn, "SELECT * FROM users WHERE role='staff'");

    while ($u = mysqli_fetch_assoc($users)) {

        $user_id = $u['id'];

        // Get attendance
        $att = mysqli_query($conn, "SELECT 
                    SUM(overtime_minutes) as ot,
                    SUM(late_minutes) as late
                FROM attendance
                WHERE user_id='$user_id'");

        $a = mysqli_fetch_assoc($att);

        $overtime_hours = $a['ot'] / 60;
        $late_minutes = $a['late'];

        // BASIC SALARY (default example)
        $basic = 15000;

        // CALCULATION
        $overtime_pay = $overtime_hours * 20;
        $deduction = $late_minutes * 10;

        $net = ($basic + $overtime_pay) - $deduction;

        // CHECK IF EXISTS
        $check = mysqli_query($conn, "SELECT * FROM salary 
                    WHERE user_id='$user_id' 
                    AND month='$month' 
                    AND year='$year'");

        if (mysqli_num_rows($check) == 0) {

            mysqli_query($conn, "INSERT INTO salary 
                (user_id, month, year, basic_salary, overtime_pay, deduction, net_salary)
                VALUES 
                ('$user_id','$month','$year','$basic','$overtime_pay','$deduction','$net')");
        }
    }

    echo "Salary Generated Successfully";
}

// ================= READ =================
if ($action == "read") {

    $sql = "SELECT s.*, u.name 
            FROM salary s
            JOIN users u ON s.user_id = u.id
            ORDER BY s.id DESC";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        echo "
        <tr>
            <td>{$row['name']}</td>
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
