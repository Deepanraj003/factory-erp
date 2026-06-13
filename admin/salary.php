<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar_admin.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="main-content">

    <div class="container-fluid">

        <h3>Salary Management</h3>

        <div class="card-box mb-3">

            <button class="btn btn-primary" onclick="generateSalary()">
                + Generate Monthly Salary
            </button>

        </div>

        <div class="card-box">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Staff</th>
                        <th>Month</th>
                        <th>Basic</th>
                        <th>Overtime</th>
                        <th>Deduction</th>
                        <th>Net Salary</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody id="salaryTable"></tbody>
            </table>

        </div>

    </div>

</div>

<script>
    loadSalary();

    function generateSalary() {

        fetch("salary_action.php?action=generate")
            .then(res => res.text())
            .then(data => {
                alert(data);
                loadSalary();
            });
    }

    function loadSalary() {

        fetch("salary_action.php?action=read")
            .then(res => res.text())
            .then(data => {
                document.getElementById("salaryTable").innerHTML = data;
            });
    }
</script>

<?php include("../includes/footer.php"); ?>