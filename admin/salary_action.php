<?php

include("../config/db.php");

$action = $_GET['action'];

$month = date("F");
$year = date("Y");


// ================= GENERATE SALARY =================
if ($action == "generate") {

    $users = mysqli_query($conn, "
        SELECT
            u.id,
            u.name,
            u.department_id,
            d.department_salary,
            d.name AS department_name

        FROM users u

        LEFT JOIN departments d
        ON u.department_id = d.id

        WHERE u.role='staff'
    ");

    while ($u = mysqli_fetch_assoc($users)) {

        $user_id = $u['id'];

        // Department Monthly Salary
        $department_salary =
            $u['department_salary'] ?? 0;

        // Prevent Empty Salary
        if (empty($department_salary)) {
            $department_salary = 0;
        }

        // Total Days In Current Month
        $days_in_month = date("t");

        // Per Day Salary
        $per_day_salary =
            $department_salary /
            $days_in_month;


        // ================= ATTENDANCE =================
        $attendance = mysqli_query(
            $conn,
            "
            SELECT

                COUNT(work_date)
                AS working_days,

                SUM(overtime_minutes)
                AS total_ot,

                SUM(late_minutes)
                AS total_late

            FROM attendance

            WHERE user_id='$user_id'

            AND MONTH(work_date)=MONTH(CURDATE())

            AND YEAR(work_date)=YEAR(CURDATE())

            AND status='Present'
        "
        );

        $a = mysqli_fetch_assoc($attendance);

        // Attendance Values
        $working_days =
            $a['working_days'] ?? 0;

        $overtime_minutes =
            $a['total_ot'] ?? 0;

        $late_minutes =
            $a['total_late'] ?? 0;

        // Fix NULL Values
        if (empty($overtime_minutes)) {
            $overtime_minutes = 0;
        }

        if (empty($late_minutes)) {
            $late_minutes = 0;
        }


        // ================= SALARY CALCULATION =================

        // Salary Based On Working Days
        $basic_salary =
            $working_days *
            $per_day_salary;

        // Overtime Pay
        $overtime_hours =
            $overtime_minutes / 60;

        $overtime_pay =
            $overtime_hours * 20;

        // Late Deduction
        $deduction =
            $late_minutes * 10;

        // Final Salary
        $net_salary =
            $basic_salary +
            $overtime_pay -
            $deduction;

        // Round Values
        $basic_salary =
            round($basic_salary, 2);

        $overtime_pay =
            round($overtime_pay, 2);

        $deduction =
            round($deduction, 2);

        $net_salary =
            round($net_salary, 2);


        // ================= PREVENT DUPLICATE =================
        $check = mysqli_query(
            $conn,
            "
            SELECT id

            FROM salary

            WHERE user_id='$user_id'

            AND month='$month'

            AND year='$year'
        "
        );

        if (mysqli_num_rows($check) == 0) {

            mysqli_query($conn, "
                INSERT INTO salary
                (
                    user_id,
                    month,
                    year,
                    basic_salary,
                    overtime_pay,
                    deduction,
                    net_salary,
                    status
                )

                VALUES
                (
                    '$user_id',
                    '$month',
                    '$year',
                    '$basic_salary',
                    '$overtime_pay',
                    '$deduction',
                    '$net_salary',
                    'pending'
                )
            ");
        }
    }

    echo "Monthly Salary Generated Successfully";
}




// ================= READ SALARY =================
if ($action == "read") {

    $result = mysqli_query(
        $conn,
        "
        SELECT
            s.*,
            u.name,
            d.name AS department_name

        FROM salary s

        JOIN users u
        ON s.user_id = u.id

        LEFT JOIN departments d
        ON u.department_id = d.id

        ORDER BY s.id DESC
    "
    );

    while ($row = mysqli_fetch_assoc($result)) {

        $details = "
            <b>Basic Salary:</b>
            ₹{$row['basic_salary']}
            <br>

            <b>Overtime Added:</b>
            ₹{$row['overtime_pay']}
            <br>

            <b>Late Deduction:</b>
            ₹{$row['deduction']}
            <br>

            <b>Final Salary:</b>
            ₹{$row['net_salary']}
        ";

        echo "
        <tr>

            <td>
                {$row['name']}
            </td>

            <td>
                {$row['department_name']}
            </td>

            <td>
                {$row['month']} {$row['year']}
            </td>

            <td>
                ₹{$row['basic_salary']}
            </td>

            <td>
                ₹{$row['overtime_pay']}
            </td>

            <td>
                ₹{$row['deduction']}
            </td>

            <td>
                <b class='text-success'>
                    ₹{$row['net_salary']}
                </b>
            </td>

            <td>
                $details
            </td>

            <td>
        ";

        if ($row['status'] == "paid") {

            echo "
                <span class='badge bg-success'>
                    Paid
                </span>
            ";
        } else {

            echo "
                <span class='badge bg-warning text-dark'>
                    Pending
                </span>
            ";
        }

        echo "
            </td>

        </tr>
        ";
    }
}
