<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar_staff.php"); ?>
<?php include("../includes/navbar.php"); ?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("../config/db.php");

$user_id = $_SESSION['id'];

/* TODAY DATE */
$today = date('Y-m-d');

/* TODAY ATTENDANCE STATUS */
$attendance = mysqli_query($conn, "
    SELECT * FROM attendance 
    WHERE user_id='$user_id' 
    AND work_date='$today'
");

$attData = mysqli_fetch_assoc($attendance);

$checkinStatus = "Not Marked";
if ($attData) {
    $checkinStatus = $attData['status'];
}

/* LATEST SALARY */
$salary = mysqli_query($conn, "
    SELECT * FROM salary 
    WHERE user_id='$user_id' 
    ORDER BY id DESC LIMIT 1
");

$salaryData = mysqli_fetch_assoc($salary);

/* LEAVE STATUS */
$leave = mysqli_query($conn, "
    SELECT COUNT(*) as total 
    FROM leaves 
    WHERE user_id='$user_id' 
    AND status='Pending'
");

$leaveCount = mysqli_fetch_assoc($leave)['total'];
?>

<div class="main-content">

    <div class="container-fluid">

        <h3 class="mb-4">Staff Dashboard</h3>

        <div class="row">

            <!-- ATTENDANCE -->
            <div class="col-md-4">
                <div class="card-box text-center">
                    <h6>Today's Attendance</h6>
                    <h3><?php echo $checkinStatus; ?></h3>
                    <p>Check-in / Check-out Status</p>
                </div>
            </div>

            <!-- SALARY -->
            <div class="col-md-4">
                <div class="card-box text-center">
                    <h6>My Salary</h6>
                    <h3>
                        <?php
                        echo $salaryData ? $salaryData['net_salary'] : "0";
                        ?>
                    </h3>
                    <p>Latest Monthly Salary</p>
                </div>
            </div>

            <!-- LEAVE -->
            <div class="col-md-4">
                <div class="card-box text-center">
                    <h6>Leave Requests</h6>
                    <h3><?php echo $leaveCount; ?></h3>
                    <p>Pending Leave Status</p>
                </div>
            </div>

        </div>

    </div>

</div>

<?php include("../includes/footer.php"); ?>