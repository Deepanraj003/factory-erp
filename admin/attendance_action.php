<?php
include("../config/db.php");

$action = $_GET['action'];

// ================= ADMIN READ ALL ATTENDANCE =================
if ($action == "admin_read") {

    $date = isset($_GET['date']) ? $_GET['date'] : "";

    $sql = "SELECT a.*, u.name 
            FROM attendance a
            JOIN users u ON a.user_id = u.id
            WHERE 1=1";

    if ($date != "") {
        $sql .= " AND a.work_date='$date'";
    }

    $sql .= " ORDER BY a.id DESC";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        echo "
        <tr>
            <td>{$row['name']}</td>
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
