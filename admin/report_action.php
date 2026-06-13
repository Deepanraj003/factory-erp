<?php
include("../config/db.php");

$action = $_GET['action'];

// ================= ADMIN READ =================
if ($action == "admin_read") {

    $sql = "SELECT d.*, u.name 
            FROM daily_reports d
            JOIN users u ON d.user_id = u.id
            ORDER BY d.id DESC";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        echo "
        <tr>
            <td>{$row['name']}</td>
            <td>{$row['work_date']}</td>
            <td>{$row['title']}</td>
            <td>{$row['description']}</td>
        </tr>
        ";
    }
}
