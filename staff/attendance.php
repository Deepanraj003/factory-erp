<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar_staff.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="main-content">

    <div class="container-fluid">

        <h3>My Attendance</h3>

        <!-- ✅ ATTENDANCE RULES BOX -->
        <div class="card-box mb-3" style="background:#f8f9fa;border-left:5px solid #0d6efd;">
            <h5>📌 Attendance Rules</h5>
            <ul style="margin-bottom:0;">
                <li>✔ Check-In must be before 9:00 AM</li>
                <li>✔ Late after 9:00 AM will be counted</li>
                <li>✔ Check-Out is mandatory for salary calculation</li>
                <li>✔ Overtime is calculated after 8 working hours</li>
                <li>✔ Missing check-out will affect salary</li>
            </ul>
        </div>

        <!-- BUTTON BOX -->
        <div class="card-box mb-3">

            <button class="btn btn-success" onclick="checkIn()">Check-In</button>
            <button class="btn btn-danger" onclick="checkOut()">Check-Out</button>

            <div id="msg" class="mt-2"></div>

        </div>

        <!-- TABLE -->
        <div class="card-box">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Late (min)</th>
                        <th>Overtime (min)</th>
                        <th>Total Hours</th>
                    </tr>
                </thead>

                <tbody id="attTable"></tbody>
            </table>

        </div>

    </div>

</div>

<script>
    loadAttendance();

    function checkIn() {
        fetch("attendance_action.php?action=checkin")
            .then(res => res.text())
            .then(data => {
                document.getElementById("msg").innerHTML = data;
                loadAttendance();
            });
    }

    function checkOut() {
        fetch("attendance_action.php?action=checkout")
            .then(res => res.text())
            .then(data => {
                document.getElementById("msg").innerHTML = data;
                loadAttendance();
            });
    }

    function loadAttendance() {
        fetch("attendance_action.php?action=read")
            .then(res => res.text())
            .then(data => {
                document.getElementById("attTable").innerHTML = data;
            });
    }
</script>

<?php include("../includes/footer.php"); ?>