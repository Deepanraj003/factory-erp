<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar_admin.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="main-content">

    <div class="container-fluid">

        <h3>Departments</h3>

        <div class="card-box mb-3">

            <input type="text" id="name" class="form-control mb-2" placeholder="Department Name">
            <button class="btn btn-primary" onclick="addDept()">Add</button>

        </div>

        <div class="card-box">

            <table class="table table-bordered">
                <tbody id="deptTable"></tbody>
            </table>

        </div>

    </div>

</div>

<script>
    loadDept();

    function addDept() {
        let formData = new FormData();
        formData.append("name", document.getElementById("name").value);

        fetch("department_action.php?action=add", {
                method: "POST",
                body: formData
            })
            .then(res => res.text())
            .then(data => {
                alert(data);
                loadDept();
            });
    }

    function loadDept() {
        fetch("department_action.php?action=read")
            .then(res => res.text())
            .then(data => {
                document.getElementById("deptTable").innerHTML = data;
            });
    }
</script>

<?php include("../includes/footer.php"); ?>