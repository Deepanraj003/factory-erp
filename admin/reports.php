<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar_admin.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="main-content">

    <div class="container-fluid">

        <h3>All Daily Reports</h3>

        <div class="card-box">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Staff</th>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Description</th>
                    </tr>
                </thead>

                <tbody id="adminReportTable"></tbody>
            </table>

        </div>

    </div>

</div>

<script>
    loadReports();

    function loadReports() {

        fetch("report_action.php?action=admin_read")
            .then(res => res.text())
            .then(data => {
                document.getElementById("adminReportTable").innerHTML = data;
            });
    }
</script>

<?php include("../includes/footer.php"); ?>