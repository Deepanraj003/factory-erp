<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar_admin.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="main-content">

    <div class="container-fluid">

        <h3>Leave Management</h3>

        <div class="card-box">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Staff</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="adminLeaveTable"></tbody>
            </table>

        </div>

    </div>

</div>

<script>
    loadAdminLeaves();

    function loadAdminLeaves() {

        fetch("leave_action.php?action=admin_read")
            .then(res => res.text())
            .then(data => {
                document.getElementById("adminLeaveTable").innerHTML = data;
            });
    }

    function updateLeave(id, status) {

        let formData = new FormData();
        formData.append("id", id);
        formData.append("status", status);

        fetch("leave_action.php?action=update", {
                method: "POST",
                body: formData
            })
            .then(res => res.text())
            .then(data => {
                alert(data);
                loadAdminLeaves();
            });
    }
</script>

<?php include("../includes/footer.php"); ?>