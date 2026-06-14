<?php

include("../config/db.php");

$action = $_GET['action'];


// ================= SAVE (ADD / UPDATE) =================
if ($action == "save") {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $salary = $_POST['salary'];

    // UPDATE
    if (!empty($id)) {

        mysqli_query($conn, "
            UPDATE departments SET
            name='$name',
            department_salary='$salary'
            WHERE id='$id'
        ");

        echo "Department Updated Successfully";
    }

    // INSERT
    else {

        mysqli_query($conn, "
            INSERT INTO departments
            (
                name,
                department_salary
            )
            VALUES
            (
                '$name',
                '$salary'
            )
        ");

        echo "Department Added Successfully";
    }
}



// ================= READ =================
if ($action == "read") {

    $sql = "
        SELECT *
        FROM departments
        ORDER BY id DESC
    ";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        echo "
        <tr>

            <td>{$row['id']}</td>

            <td>{$row['name']}</td>

            <td>₹ {$row['department_salary']}</td>

            <td>

                <button
                    class='btn btn-warning btn-sm me-1'
                    onclick=\"editDept(
                        '{$row['id']}',
                        '{$row['name']}',
                        '{$row['department_salary']}'
                    )\">

                    Edit
                </button>

                <button
                    class='btn btn-danger btn-sm'
                    onclick='deleteDept({$row['id']})'>

                    Delete
                </button>

            </td>

        </tr>
        ";
    }
}



// ================= DELETE =================
if ($action == "delete") {

    $id = $_GET['id'];

    mysqli_query(
        $conn,
        "DELETE FROM departments WHERE id='$id'"
    );

    echo "Department Deleted Successfully";
}
