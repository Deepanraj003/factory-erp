<?php
include("../config/db.php");
$action = $_GET['action'];

// ADMIN VIEW ALL LEAVES
if ($action == "admin_read") {

    $sql = "SELECT l.*, u.name 
            FROM leaves l
            JOIN users u ON l.user_id = u.id
            ORDER BY l.id DESC";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        echo "
        <tr>
            <td>{$row['name']}</td>
            <td>{$row['from_date']}</td>
            <td>{$row['to_date']}</td>
            <td>{$row['reason']}</td>
            <td>{$row['status']}</td>

            <td>
                <button onclick=\"updateLeave({$row['id']},'approved')\" class='btn btn-success btn-sm'>Approve</button>
                <button onclick=\"updateLeave({$row['id']},'rejected')\" class='btn btn-danger btn-sm'>Reject</button>
            </td>
        </tr>
        ";
    }
}

// UPDATE STATUS
if ($action == "update") {

    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE leaves SET status='$status' WHERE id='$id'";

    echo mysqli_query($conn, $sql) ? "Updated" : "Error";
}
