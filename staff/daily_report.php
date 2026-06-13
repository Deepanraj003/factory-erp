<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar_staff.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="main-content">

    <div class="container-fluid">

        <h3>Daily Work Report</h3>

        <div class="card-box mb-3">

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reportModal">
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
<div class="modal fade" id="reportModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Submit Report</h5>
            </div>

            <div class="modal-body">

                <input type="text" id="title" class="form-control mb-2" placeholder="Work Title">
                <textarea id="description" class="form-control mb-2" placeholder="Description"></textarea>

            </div>

            <div class="modal-footer">
                <button class="btn btn-success" onclick="submitReport()">Submit</button>
            </div>

        </div>
    </div>
</div>

<script>
    loadReports();

    function submitReport() {

        let formData = new FormData();
        formData.append("title", document.getElementById("title").value);
        formData.append("description", document.getElementById("description").value);

        fetch("report_action.php?action=add", {
                method: "POST",
                body: formData
            })
            .then(res => res.text())
            .then(data => {
                alert(data);
                loadReports();
            });
    }

    function loadReports() {

        fetch("report_action.php?action=read")
            .then(res => res.text())
            .then(data => {
                document.getElementById("reportTable").innerHTML = data;
            });
    }
</script>

<?php include("../includes/footer.php"); ?>