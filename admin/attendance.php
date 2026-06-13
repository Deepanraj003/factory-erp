<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar_admin.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="main-content">

    <div class="container-fluid">

        <h3>Attendance Management</h3>

        <div class="card-box mb-3">

            <input type="date" id="filterDate" class="form-control w-25 d-inline">

            <button class="btn btn-primary" onclick="loadAttendance()">
                Filter
            </button>

        </div>

        <div class="card-box">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Staff</th>
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

    function loadAttendance() {

        let date = document.getElementById("filterDate").value;

        fetch("attendance_action.php?action=admin_read&date=" + date)
            .then(res => res.text())
            .then(data => {
                document.getElementById("attTable").innerHTML = data;
            });
    }
</script>

<?php include("../includes/footer.php"); ?>