<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar_admin.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="main-content">

    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-3">
            <h3>Staff Management</h3>
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
                        <th width="180">Action</th>
                    </tr>
                </thead>

                <tbody id="staffTable"></tbody>

            </table>

        </div>

    </div>

</div>


<!-- EDIT MODAL -->
<div class="modal fade" id="staffModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Edit Staff
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <input
                    type="hidden"
                    id="id">

                <input
                    type="text"
                    id="name"
                    class="form-control mb-2"
                    placeholder="Name">

                <input
                    type="email"
                    id="email"
                    class="form-control mb-2"
                    placeholder="Email">

                <input
                    type="text"
                    id="employee_id"
                    class="form-control mb-2"
                    placeholder="Employee ID">


                <!-- Department -->
                <select
                    id="department_id"
                    class="form-control mb-2">

                    <option value="">
                        Select Department
                    </option>

                    <?php
                    include("../config/db.php");

                    $dep = mysqli_query(
                        $conn,
                        "SELECT * FROM departments"
                    );

                    while (
                        $d = mysqli_fetch_assoc($dep)
                    ) {
                        echo "
                        <option value='{$d['id']}'>
                            {$d['name']}
                        </option>
                        ";
                    }
                    ?>

                </select>

                <input
                    type="password"
                    id="password"
                    class="form-control"
                    placeholder="New Password (Optional)">

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-success"
                    onclick="updateStaff()">

                    Update
                </button>

                <button
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Close
                </button>

            </div>

        </div>

    </div>

</div>



<script>
    loadStaff();


    // ================= LOAD =================
    function loadStaff() {

        fetch(
                "staff_action.php?action=read"
            )
            .then(res => res.text())
            .then(data => {

                document.getElementById(
                    "staffTable"
                ).innerHTML = data;
            });
    }



    // ================= EDIT =================
    function editStaff(id) {

        fetch(
                "staff_action.php?action=read_single&id=" +
                id
            )
            .then(res => res.json())
            .then(data => {

                document.getElementById(
                    "id"
                ).value = data.id;

                document.getElementById(
                    "name"
                ).value = data.name;

                document.getElementById(
                    "email"
                ).value = data.email;

                document.getElementById(
                        "employee_id"
                    ).value =
                    data.employee_id;

                document.getElementById(
                        "department_id"
                    ).value =
                    data.department_id;


                new bootstrap.Modal(
                    document.getElementById(
                        'staffModal'
                    )
                ).show();
            });
    }



    // ================= UPDATE =================
    function updateStaff() {

        let formData =
            new FormData();

        formData.append(
            "id",
            document.getElementById("id")
            .value
        );

        formData.append(
            "name",
            document.getElementById("name")
            .value
        );

        formData.append(
            "email",
            document.getElementById("email")
            .value
        );

        formData.append(
            "employee_id",
            document.getElementById(
                "employee_id"
            ).value
        );

        formData.append(
            "department_id",
            document.getElementById(
                "department_id"
            ).value
        );

        formData.append(
            "password",
            document.getElementById(
                "password"
            ).value
        );


        fetch(
                "staff_action.php?action=save", {
                    method: "POST",
                    body: formData
                }
            )
            .then(res => res.text())
            .then(data => {

                alert(data);

                bootstrap.Modal
                    .getInstance(
                        document
                        .getElementById(
                            'staffModal'
                        )
                    )
                    .hide();

                loadStaff();
            });
    }



    // ================= DELETE =================
    function deleteStaff(id) {

        if (
            confirm(
                "Delete this staff?"
            )
        ) {

            let formData =
                new FormData();

            formData.append(
                "id",
                id
            );

            fetch(
                    "staff_action.php?action=delete", {
                        method: "POST",
                        body: formData
                    }
                )
                .then(res => res.text())
                .then(data => {

                    alert(data);

                    loadStaff();
                });
        }
    }
</script>

<?php include("../includes/footer.php"); ?>