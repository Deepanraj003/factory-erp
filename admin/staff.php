<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar_admin.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="main-content">

    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-3">
            <h3>Staff Management</h3>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staffModal">
                + Add Staff
            </button>
        </div>

        <div class="card-box">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Employee ID</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="staffTable"></tbody>

            </table>

        </div>

    </div>

</div>

<!-- MODAL -->
<div class="modal fade" id="staffModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <input type="hidden" id="id">

                <input type="text" id="name" class="form-control mb-2" placeholder="Name">
                <input type="email" id="email" class="form-control mb-2" placeholder="Email">
                <input type="text" id="employee_id" class="form-control mb-2" placeholder="Employee ID">

                <select id="department_id" class="form-control mb-2">
                    <option value="">Select Department</option>
                    <?php
                    include("../config/db.php");
                    $dep = mysqli_query($conn, "SELECT * FROM departments");
                    while ($d = mysqli_fetch_assoc($dep)) {
                        echo "<option value='{$d['id']}'>{$d['name']}</option>";
                    }
                    ?>
                </select>

                <input type="password" id="password" class="form-control mb-2" placeholder="Password">

            </div>

            <div class="modal-footer">
                <button class="btn btn-success" onclick="saveStaff()">Save</button>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<script>
    loadStaff();

    function loadStaff() {
        fetch("staff_action.php?action=read")
            .then(res => res.text())
            .then(data => {
                document.getElementById("staffTable").innerHTML = data;
            });
    }

    // ✅ SAVE WITH FULL VALIDATION
    function saveStaff() {

        let id = document.getElementById("id").value;
        let name = document.getElementById("name").value.trim();
        let email = document.getElementById("email").value.trim();
        let employee_id = document.getElementById("employee_id").value.trim();
        let department_id = document.getElementById("department_id").value;
        let password = document.getElementById("password").value;

        // ❌ VALIDATION CHECK
        if (name === "") {
            alert("Name is required");
            return;
        }

        if (email === "") {
            alert("Email is required");
            return;
        }

        if (employee_id === "") {
            alert("Employee ID is required");
            return;
        }

        if (department_id === "") {
            alert("Please select department");
            return;
        }

        if (password === "") {
            alert("Password is required");
            return;
        }

        let formData = new FormData();
        formData.append("id", id);
        formData.append("name", name);
        formData.append("email", email);
        formData.append("employee_id", employee_id);
        formData.append("department_id", department_id);
        formData.append("password", password);

        fetch("staff_action.php?action=save", {
                method: "POST",
                body: formData
            })
            .then(res => res.text())
            .then(data => {

                alert(data);
                loadStaff();
                resetForm();

                // close modal
                let modalEl = document.getElementById('staffModal');
                let modal = bootstrap.Modal.getInstance(modalEl);

                if (modal) modal.hide();
            });
    }

    function deleteStaff(id) {

        if (confirm("Delete this staff?")) {

            let formData = new FormData();
            formData.append("id", id);

            fetch("staff_action.php?action=delete", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.text())
                .then(data => {
                    alert(data);
                    loadStaff();
                });
        }
    }

    function editStaff(id) {

        fetch("staff_action.php?action=read_single&id=" + id)
            .then(res => res.json())
            .then(data => {

                document.getElementById("id").value = data.id;
                document.getElementById("name").value = data.name;
                document.getElementById("email").value = data.email;
                document.getElementById("employee_id").value = data.employee_id;
                document.getElementById("department_id").value = data.department_id;

                new bootstrap.Modal(document.getElementById('staffModal')).show();
            });
    }

    function resetForm() {
        document.getElementById("id").value = "";
        document.getElementById("name").value = "";
        document.getElementById("email").value = "";
        document.getElementById("employee_id").value = "";
        document.getElementById("department_id").value = "";
        document.getElementById("password").value = "";
    }

    document.getElementById('staffModal').addEventListener('hidden.bs.modal', function() {
        resetForm();
    });
</script>

<?php include("../includes/footer.php"); ?>