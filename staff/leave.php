<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar_staff.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="main-content">

    <div class="container-fluid">

        <h3>Apply Leave</h3>

        <div class="card-box mb-3">

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#leaveModal">
                + Apply Leave
            </button>

        </div>

        <div class="card-box">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>From</th>
                        <th>To</th>
                        <th>Reason</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody id="leaveTable"></tbody>
            </table>

        </div>

    </div>

</div>

<!-- LEAVE MODAL -->
<div class="modal fade" id="leaveModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- HEADER -->
            <div class="modal-header">
                <h5 class="modal-title">Apply Leave</h5>

                <!-- CLOSE BUTTON -->
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body">

                <input type="date" id="from_date" class="form-control mb-2">
                <input type="date" id="to_date" class="form-control mb-2">
                <textarea id="reason" class="form-control mb-2" placeholder="Reason"></textarea>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer">
                <button class="btn btn-success" onclick="applyLeave()">Submit</button>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<script>
    loadLeaves();

    function applyLeave() {

        let from_date = document.getElementById("from_date").value;
        let to_date = document.getElementById("to_date").value;
        let reason = document.getElementById("reason").value.trim();

        // ❌ VALIDATION
        if (from_date === "") {
            alert("Please select From Date");
            return;
        }

        if (to_date === "") {
            alert("Please select To Date");
            return;
        }

        if (reason === "") {
            alert("Please enter reason");
            return;
        }

        let formData = new FormData();
        formData.append("from_date", from_date);
        formData.append("to_date", to_date);
        formData.append("reason", reason);

        fetch("leave_action.php?action=apply", {
                method: "POST",
                body: formData
            })
            .then(res => res.text())
            .then(data => {

                alert(data);

                loadLeaves();
                resetLeaveForm();

                // close modal
                let modalEl = document.getElementById('leaveModal');
                let modal = bootstrap.Modal.getInstance(modalEl);

                if (modal) modal.hide();
            });
    }

    function loadLeaves() {
        fetch("leave_action.php?action=read")
            .then(res => res.text())
            .then(data => {
                document.getElementById("leaveTable").innerHTML = data;
            });
    }

    function resetLeaveForm() {
        document.getElementById("from_date").value = "";
        document.getElementById("to_date").value = "";
        document.getElementById("reason").value = "";
    }

    // reset when modal closed manually
    document.getElementById('leaveModal').addEventListener('hidden.bs.modal', function() {
        resetLeaveForm();
    });
</script>

<?php include("../includes/footer.php"); ?>