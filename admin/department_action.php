<?php
include("../config/db.php");

$action = $_GET['action'];

if ($action == "add") {

    $name = $_POST['name'];

    mysqli_query($conn, "INSERT INTO departments(name) VALUES('$name')");
    echo "Added";
}

if ($action == "read") {

    $sql = "SELECT * FROM departments";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>{$row['name']}</td></tr>";
    }
}
