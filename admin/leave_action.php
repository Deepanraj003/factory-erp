<?php
include("../config/db.php");

$action = $_GET['action'];


// ================= ADMIN VIEW =================
if ($action == "admin_read") {

    $sql = "
        SELECT
            l.*,
            u.name

        FROM leaves l

        JOIN users u
        ON l.user_id = u.id

        ORDER BY l.id DESC
    ";

    $result = mysqli_query(
        $conn,
        $sql
    );

    while (
        $row = mysqli_fetch_assoc(
            $result
        )
    ) {

        echo "
        <tr>

            <td>
                {$row['name']}
            </td>

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
            == "approved"
        ) {

            echo "
            <span class='badge bg-success'>
                Approved
            </span>
            ";
        } elseif (
            $row['status']
            == "rejected"
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

            <td>
                <button
                    onclick=\"updateLeave({$row['id']},'approved')\"
                    class='btn btn-success btn-sm'>

                    Approve
                </button>

                <button
                    onclick=\"updateLeave({$row['id']},'rejected')\"
                    class='btn btn-danger btn-sm'>

                    Reject
                </button>
            </td>

        </tr>
        ";
    }
}



// ================= UPDATE STATUS =================
if ($action == "update") {

    $id =
        $_POST['id'];

    $status =
        $_POST['status'];


    // Get Leave Details
    $leave_query =
        mysqli_query(
            $conn,
            "
            SELECT *
            FROM leaves
            WHERE id='$id'
            "
        );

    $leave =
        mysqli_fetch_assoc(
            $leave_query
        );

    $user_id =
        $leave['user_id'];


    // Update Leave Status
    $sql =
        "
        UPDATE leaves
        SET status='$status'
        WHERE id='$id'
        ";

    if (
        mysqli_query(
            $conn,
            $sql
        )
    ) {

        // Notification Message
        if (
            $status
            == "approved"
        ) {

            $message =
                "Your leave request has been approved.";
        } else {

            $message =
                "Your leave request has been rejected.";
        }


        // Insert Notification
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
                '$user_id',
                '$message',
                '0'
            )
            "
        );

        echo "Updated";
    } else {

        echo "Error";
    }
}
