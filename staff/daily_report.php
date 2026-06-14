<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar_staff.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="main-content">

    <div class="container-fluid">

        <h3>Daily Work Report</h3>

        <div class="card-box mb-3">

            <button class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#reportModal">
                + Submit Report
            </button>

        </div>

        <div class="card-box">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Description</th>
                    </tr>
                </thead>

                <tbody id="reportTable"></tbody>
            </table>

        </div>

    </div>

</div>

<!-- REPORT MODAL -->
<div class="modal fade" id="reportModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title text-dark">
                    Submit Report
                </h5>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <input type="text"
                    id="title"
                    class="form-control mb-3"
                    placeholder="Work Title">

                <textarea id="description"
                    class="form-control"
                    rows="4"
                    placeholder="Description"></textarea>

                <!-- Error Message -->
                <div id="errorMsg"
                    class="text-danger mt-2"
                    style="display:none;">
                </div>

            </div>

            <!-- Footer -->
            <div class="modal-footer">

                <button type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Close
                </button>

                <button type="button"
                    class="btn btn-success"
                    onclick="submitReport()">
                    Submit
                </button>

            </div>

        </div>
    </div>
</div>

<script>
    loadReports();

    function submitReport() {

        let title =
            document.getElementById("title")
            .value.trim();

        let description =
            document.getElementById("description")
            .value.trim();

        let errorMsg =
            document.getElementById("errorMsg");

        // Validation
        if (title === "") {
            errorMsg.style.display = "block";
            errorMsg.innerHTML =
                "Work Title is required!";
            return;
        }

        if (description === "") {
            errorMsg.style.display = "block";
            errorMsg.innerHTML =
                "Description is required!";
            return;
        }

        errorMsg.style.display = "none";

        let formData = new FormData();

        formData.append("title", title);
        formData.append("description", description);

        fetch("report_action.php?action=add", {
                method: "POST",
                body: formData
            })
            .then(res => res.text())
            .then(data => {

                alert(data);

                // Reload reports
                loadReports();

                // Clear form
                document.getElementById("title")
                    .value = "";

                document.getElementById(
                        "description")
                    .value = "";

                // Close modal automatically
                let modal =
                    bootstrap.Modal.getInstance(
                        document.getElementById(
                            'reportModal'
                        )
                    );

                modal.hide();
            });
    }

    function loadReports() {

        fetch(
                "report_action.php?action=read"
            )
            .then(res => res.text())
            .then(data => {

                document
                    .getElementById(
                        "reportTable"
                    )
                    .innerHTML = data;
            });
    }
</script>

<?php include("../includes/footer.php"); ?>