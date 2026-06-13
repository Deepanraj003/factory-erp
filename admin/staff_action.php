<?php
include("../config/db.php");

$action = $_GET['action'] ?? "";

/* ================= READ ALL ================= */
if ($action == "read") {

    $sql = "SELECT users.*, departments.name AS dept_name
            FROM users
            LEFT JOIN departments
            ON users.department_id = departments.id
            WHERE role='staff'";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        echo "
        <tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['employee_id']}</td>
            <td>{$row['dept_name']}</td>
            <td>
                <button onclick='editStaff({$row['id']})' class='btn btn-warning btn-sm'>Edit</button>
                <button onclick='deleteStaff({$row['id']})' class='btn btn-danger btn-sm'>Delete</button>
            </td>
        </tr>
        ";
    }
}

/* ================= READ SINGLE ================= */
if ($action == "read_single") {

    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    echo json_encode(mysqli_fetch_assoc($result));
}

/* ================= SAVE ================= */
if ($action == "save") {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $employee_id = $_POST['employee_id'];
    $department_id = $_POST['department_id'];
    $password = $_POST['password'];

    if (!empty($password)) {
        $password = md5($password);
    }

    if ($id == "") {

        $sql = "INSERT INTO users 
        (name,email,employee_id,department_id,password,role)
        VALUES
        ('$name','$email','$employee_id','$department_id','$password','staff')";

        echo mysqli_query($conn, $sql) ? "Staff Added" : "Error";
    } else {

        if ($password) {
            $sql = "UPDATE users SET
            name='$name',
            email='$email',
            employee_id='$employee_id',
            department_id='$department_id',
            password='$password'
            WHERE id='$id'";
        } else {
            $sql = "UPDATE users SET
            name='$name',
            email='$email',
            employee_id='$employee_id',
            department_id='$department_id'
            WHERE id='$id'";
        }

        echo mysqli_query($conn, $sql) ? "Updated" : "Error";
    }
}

/* ================= DELETE ================= */
if ($action == "delete") {

    $id = $_POST['id'];

    $sql = "DELETE FROM users WHERE id='$id' AND role='staff'";

    echo mysqli_query($conn, $sql) ? "Deleted" : "Error";
}
