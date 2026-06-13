<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar_admin.php"); ?>
<?php include("../includes/navbar.php"); ?>

<?php
include("../config/db.php");

$today = date('Y-m-d');

/* TOTAL STAFF */
$totalStaff = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) as total FROM users WHERE role='staff'"
))['total'];

/* TODAY ATTENDANCE (FIXED USING work_date) */
$todayAttendance = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) as total FROM attendance WHERE work_date='$today'"
))['total'];

/* PRESENT TODAY */
$presentToday = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) as total FROM attendance WHERE work_date='$today' AND status='Present'"
))['total'];

/* LATE TODAY */
$lateToday = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) as total FROM attendance WHERE work_date='$today' AND late_minutes > 0"
))['total'];

/* TOTAL LEAVES (if table exists) */
$pendingLeaves = 0;
$checkLeaves = mysqli_query($conn, "SHOW TABLES LIKE 'leaves'");
if (mysqli_num_rows($checkLeaves) > 0) {
    $pendingLeaves = mysqli_fetch_assoc(mysqli_query(
        $conn,
        "SELECT COUNT(*) as total FROM leaves WHERE status='Pending'"
    ))['total'];
}

/* TOTAL DEPARTMENTS */
$totalDepartments = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) as total FROM departments"
))['total'];
?>

<div class="main-content">

    <div class="container-fluid">

        <h3 class="mb-4">Admin Dashboard</h3>

        <div class="row">

            <!-- STAFF -->
            <div class="col-md-3">
                <div class="card-box text-center">
                    <h6>Total Staff</h6>
                    <h3><?php echo $totalStaff; ?></h3>
                </div>
            </div>

            <!-- TODAY ATTENDANCE -->
            <div class="col-md-3">
                <div class="card-box text-center">
                    <h6>Today Attendance</h6>
                    <h3><?php echo $todayAttendance; ?></h3>
                </div>
            </div>

            <!-- PRESENT -->
            <div class="col-md-3">
                <div class="card-box text-center">
                    <h6>Present Today</h6>
                    <h3><?php echo $presentToday; ?></h3>
                </div>
            </div>

            <!-- LATE -->
            <div class="col-md-3">
                <div class="card-box text-center">
                    <h6>Late Today</h6>
                    <h3><?php echo $lateToday; ?></h3>
                </div>
            </div>

            <!-- DEPARTMENTS -->
            <div class="col-md-3 mt-3">
                <div class="card-box text-center">
                    <h6>Departments</h6>
                    <h3><?php echo $totalDepartments; ?></h3>
                </div>
            </div>

            <!-- PENDING LEAVES -->
            <div class="col-md-3 mt-3">
                <div class="card-box text-center">
                    <h6>Pending Leaves</h6>
                    <h3><?php echo $pendingLeaves; ?></h3>
                </div>
            </div>

        </div>

    </div>

</div>

<?php include("../includes/footer.php"); ?>