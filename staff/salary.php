<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar_staff.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="main-content">

    <div class="container-fluid">

        <h3>My Salary</h3>

        <!-- ✅ SALARY RULES BOX -->
        <div class="card-box mb-3" style="background:#f8f9fa;border-left:5px solid #28a745;">
            <h5>💰 Salary Rules</h5>
            <ul style="margin-bottom:0;">
                <li>✔ Salary is calculated based on monthly attendance</li>
                <li>✔ Basic salary is fixed (example: ₹15000)</li>
                <li>✔ Overtime is paid per extra working hour</li>
                <li>✔ Late coming will reduce salary (deduction)</li>
                <li>✔ Salary will be generated at end of month</li>
                <li>✔ Status shows Pending / Approved by Admin</li>
            </ul>
        </div>

        <!-- SALARY TABLE -->
        <div class="card-box">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Basic</th>
                        <th>Overtime</th>
                        <th>Deduction</th>
                        <th>Net Salary</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody id="mySalary"></tbody>
            </table>

        </div>

    </div>

</div>

<script>
    loadSalary();

    function loadSalary() {

        fetch("salary_action.php?action=my_salary")
            .then(res => res.text())
            .then(data => {
                document.getElementById("mySalary").innerHTML = data;
            });
    }
</script>

<?php include("../includes/footer.php"); ?>