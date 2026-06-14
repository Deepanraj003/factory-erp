<?php

include("../config/db.php");

if (
    session_status()
    == PHP_SESSION_NONE
) {
    session_start();
}

$user_id =
    $_SESSION['id'];

$action =
    $_GET['action'];


// ================= APPLY LEAVE =================
if ($action == "apply") {

    $from =
        trim($_POST['from_date']);

    $to =
        trim($_POST['to_date']);

    $reason =
        trim($_POST['reason']);


    // VALIDATION
    if (
        $from == "" ||
        $to == "" ||
        $reason == ""
    ) {

        echo "All fields are required";
        exit;
    }


    // DATE VALIDATION
    if ($to < $from) {

        echo "To date must be greater than From date";
        exit;
    }


    // Insert Leave
    $sql =
        "
        INSERT INTO leaves
        (
            user_id,
            from_date,
            to_date,
            reason,
            status
        )

        VALUES
        (
            '$user_id',
            '$from',
            '$to',
            '$reason',
            'Pending'
        )
        ";

    if (
        mysqli_query(
            $conn,
            $sql
        )
    ) {

        // ================= NOTIFICATION =================

        // Get Staff Name
        $user_query =
            mysqli_query(
                $conn,
                "
                SELECT name
                FROM users
                WHERE id='$user_id'
                "
            );

        $user =
            mysqli_fetch_assoc(
                $user_query
            );

        $staff_name =
            $user['name'];


        // Find Admin User
        $admin_query =
            mysqli_query(
                $conn,
                "
                SELECT id
                FROM users
                WHERE role='admin'
                LIMIT 1
                "
            );

        $admin =
            mysqli_fetch_assoc(
                $admin_query
            );

        $admin_id =
            $admin['id'];


        // Notification Message
        $message =
            $staff_name .
            " applied for leave from "
            . $from .
            " to "
            . $to;


        // Insert Notification For Admin
        mysqli_query(
            $conn,
            "
            INSERT INTO notifications
            (
                user_id,
                message,
                is_read
            )

            VALUES
            (
                '$admin_id',
                '$message',
                '0'
            )
            "
        );

        echo
        "Leave Applied Successfully";
    } else {

        echo
        "Error: " .
            mysqli_error($conn);
    }
}



// ================= READ STAFF LEAVES =================
if ($action == "read") {

    $sql =
        "
        SELECT *
        FROM leaves

        WHERE user_id='$user_id'

        ORDER BY id DESC
        ";

    $result =
        mysqli_query(
            $conn,
            $sql
        );

    while (
        $row =
        mysqli_fetch_assoc(
            $result
        )
    ) {

        echo "
        <tr>

            <td>
                {$row['from_date']}
            </td>

            <td>
                {$row['to_date']}
            </td>

            <td>
                {$row['reason']}
            </td>

            <td>
        ";

        if (
            $row['status']
            == "Approved"
        ) {

            echo "
            <span class='badge bg-success'>
                Approved
            </span>
            ";
        } elseif (
            $row['status']
            == "Rejected"
        ) {

            echo "
            <span class='badge bg-danger'>
                Rejected
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
