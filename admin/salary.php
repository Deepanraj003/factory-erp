<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar_admin.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="main-content">

    <div class="container-fluid">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold mb-1">
                    Salary Management
                </h2>

                <p class=" mb-0">
                    Manage monthly employee salaries and payroll details
                </p>
            </div>

            <button
                class="btn btn-primary px-4 py-2 shadow-sm"
                onclick="generateSalary()">

                <i class="fas fa-money-bill-wave me-2"></i>
                Generate Salary
            </button>

        </div>


        <!-- Salary Formula Card -->
        <!-- Salary Formula Card -->
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <div class="d-flex align-items-center mb-4">

                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow"
                        style="width:60px;height:60px;">

                        <i class="fas fa-calculator fs-4"></i>

                    </div>

                    <div class="ms-3">

                        <h4 class="fw-bold mb-1">
                            Salary Calculation Formula
                        </h4>

                        <p class="mb-0">
                            Employee salary is calculated based on attendance, working days, overtime and late deduction.
                        </p>

                    </div>

                </div>


                <div class="row g-3">

                    <!-- Department Salary -->
                    <div class="col-lg-3 col-md-6">

                        <div class="card border-0 bg-light shadow-sm h-100">

                            <div class="card-body text-center">

                                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width:60px;height:60px;">

                                    <i class="fas fa-building text-primary fs-3"></i>

                                </div>

                                <h5 class="fw-bold">
                                    Department Salary
                                </h5>

                                <p class="small mb-0">
                                    Monthly salary based on employee department
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- Working Days -->
                    <div class="col-lg-3 col-md-6">

                        <div class="card border-0 bg-light shadow-sm h-100">

                            <div class="card-body text-center">

                                <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width:60px;height:60px;">

                                    <i class="fas fa-calendar-check text-success fs-3"></i>

                                </div>

                                <h5 class="fw-bold">
                                    Working Days
                                </h5>

                                <p class=" small mb-0">
                                    Salary calculated from attendance records
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- Overtime -->
                    <div class="col-lg-3 col-md-6">

                        <div class="card border-0 bg-light shadow-sm h-100">

                            <div class="card-body text-center">

                                <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width:60px;height:60px;">

                                    <i class="fas fa-business-time text-info fs-3"></i>

                                </div>

                                <h5 class="fw-bold">
                                    Overtime
                                </h5>

                                <p class=" small mb-0">
                                    ₹20 added per overtime hour
                                </p>

                            </div>

                        </div>

                    </div>


                    <!-- Deduction -->
                    <div class="col-lg-3 col-md-6">

                        <div class="card border-0 bg-light shadow-sm h-100">

                            <div class="card-body text-center">

                                <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width:60px;height:60px;">

                                    <i class="fas fa-minus-circle text-danger fs-3"></i>

                                </div>

                                <h5 class="fw-bold">
                                    Deduction
                                </h5>

                                <p class=" small mb-0">
                                    ₹10 deducted per late minute
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- Formula Box -->
                <div class="alert alert-success mt-4 border-0 shadow-sm">

                    <div class="text-center">

                        <h5 class="fw-bold mb-3">
                            Final Salary Formula
                        </h5>

                        <div class="fs-5 fw-bold text-success">

                            (Department Salary ÷ Total Month Days × Working Days)
                            <span class="mx-2">+</span>

                            Overtime Pay
                            <span class="mx-2">−</span>

                            Late Deduction

                        </div>

                        <hr>

                        <div class="fs-4 fw-bold text-dark">

                            Final Salary =
                            Basic Salary + Overtime − Deduction

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- Salary Table -->
        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-dark">

                            <tr>
                                <th>Staff</th>
                                <th>Department</th>
                                <th>Month</th>
                                <th>Basic</th>
                                <th>Overtime</th>
                                <th>Deduction</th>
                                <th>Net Salary</th>
                                <th>Salary Details</th>
                                <th>Status</th>
                            </tr>

                        </thead>

                        <tbody id="salaryTable"></tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>


<script>
    loadSalary();

    // Generate Salary
    function generateSalary() {

        fetch(
                "salary_action.php?action=generate"
            )
            .then(res => res.text())
            .then(data => {

                alert(data);

                loadSalary();
            });
    }


    // Load Salary
    function loadSalary() {

        fetch(
                "salary_action.php?action=read"
            )
            .then(res => res.text())
            .then(data => {

                document.getElementById(
                    "salaryTable"
                ).innerHTML = data;
            });
    }
</script>

<?php include("../includes/footer.php"); ?>