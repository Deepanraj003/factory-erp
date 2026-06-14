<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar_admin.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="main-content">

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Departments Management</h3>
        </div>

        <!-- Department Form -->
        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <h5 class="mb-3">
                    Add / Update Department
                </h5>

                <input type="hidden" id="dept_id">

                <div class="row">

                    <div class="col-md-5">
                        <label class="form-label">
                            Department Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            class="form-control"
                            placeholder="Enter Department Name">
                    </div>

                    <div class="col-md-5">
                        <label class="form-label">
                            Department Salary
                        </label>

                        <input
                            type="number"
                            id="salary"
                            class="form-control"
                            placeholder="Enter Department Salary">
                    </div>

                    <div class="col-md-2 d-flex align-items-end">

                        <button
                            class="btn btn-primary w-100"
                            id="saveBtn"
                            onclick="saveDept()">

                            Save
                        </button>

                    </div>

                </div>

            </div>

        </div>


        <!-- Department Table -->
        <div class="card shadow-sm">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-dark">

                            <tr>
                                <th width="80">ID</th>
                                <th>Department Name</th>
                                <th>Salary</th>
                                <th width="180">
                                    Action
                                </th>
                            </tr>

                        </thead>

                        <tbody id="deptTable"></tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>


<script>
    loadDept();


    // ================= LOAD =================
    function loadDept() {

        fetch(
                "department_action.php?action=read"
            )
            .then(res => res.text())
            .then(data => {

                document.getElementById(
                    "deptTable"
                ).innerHTML = data;
            });
    }



    // ================= SAVE =================
    function saveDept() {

        let id =
            document.getElementById(
                "dept_id"
            ).value;

        let name =
            document.getElementById(
                "name"
            ).value;

        let salary =
            document.getElementById(
                "salary"
            ).value;


        // Validation
        if (name == "" || salary == "") {

            alert(
                "Please fill all fields"
            );

            return;
        }

        let formData = new FormData();

        formData.append("id", id);
        formData.append("name", name);
        formData.append("salary", salary);

        fetch(
                "department_action.php?action=save", {
                    method: "POST",
                    body: formData
                }
            )
            .then(res => res.text())
            .then(data => {

                alert(data);

                clearForm();

                loadDept();
            });
    }



    // ================= EDIT =================
    function editDept(
        id,
        name,
        salary
    ) {

        document.getElementById(
            "dept_id"
        ).value = id;

        document.getElementById(
            "name"
        ).value = name;

        document.getElementById(
            "salary"
        ).value = salary;

        document.getElementById(
            "saveBtn"
        ).innerText = "Update";

        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    }



    // ================= DELETE =================
    function deleteDept(id) {

        if (
            confirm(
                "Are you sure want to delete?"
            )
        ) {

            fetch(
                    "department_action.php?action=delete&id=" +
                    id
                )
                .then(res => res.text())
                .then(data => {

                    alert(data);

                    loadDept();
                });
        }
    }



    // ================= CLEAR =================
    function clearForm() {

        document.getElementById(
            "dept_id"
        ).value = "";

        document.getElementById(
            "name"
        ).value = "";

        document.getElementById(
            "salary"
        ).value = "";

        document.getElementById(
            "saveBtn"
        ).innerText = "Save";
    }
</script>

<?php include("../includes/footer.php"); ?>