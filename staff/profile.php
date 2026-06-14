<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar_staff.php"); ?>
<?php include("../includes/navbar.php"); ?>

<?php

$id = $_SESSION['id'];

$user = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT u.*, d.name AS department_name
     FROM users u
     LEFT JOIN departments d ON u.department_id = d.id
     WHERE u.id='$id'"
));

?>

<div class="main-content">
    <div class="container-fluid">

        <!-- <h3 class="mb-4">My Profile</h3> -->

        <div class="card-box p-4">

            <form method="POST" enctype="multipart/form-data">

                <div class="row">

                    <!-- Profile Image -->
                    <div class="col-md-12 text-center mb-4">

                        <?php if (!empty($user['photo'])) { ?>
                            <img src="../uploads/<?php echo $user['photo']; ?>"
                                width="120" height="120"
                                style="border-radius:50%;object-fit:cover;border:4px solid #00ffcc;">
                        <?php } else { ?>
                            <img src="../assets/img/user.png" width="120">
                        <?php } ?>

                    </div>

                    <!-- NAME -->
                    <div class="col-md-4">
                        <label>Name</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" name="name"
                                value="<?php echo $user['name']; ?>"
                                class="form-control" required>
                        </div>
                    </div>

                    <!-- EMAIL -->
                    <div class="col-md-4">
                        <label>Email</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="email" name="email"
                                value="<?php echo $user['email']; ?>"
                                class="form-control" required>
                        </div>
                    </div>

                    <!-- EMPLOYEE ID -->
                    <div class="col-md-4">
                        <label>Employee ID</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-id-badge"></i>
                            <input type="text" name="employee_id"
                                value="<?php echo $user['employee_id']; ?>"
                                class="form-control">
                        </div>
                    </div>

                    <!-- DEPARTMENT -->
                    <div class="col-md-4">
                        <label>Department</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-building"></i>

                            <select name="department_id" class="form-control form-select">

                                <option value="">Select Department</option>

                                <?php
                                $departments = mysqli_query(
                                    $conn,
                                    "SELECT id,name FROM departments ORDER BY name ASC"
                                );

                                while ($dept = mysqli_fetch_assoc($departments)) {
                                ?>

                                    <option value="<?php echo $dept['id']; ?>"
                                        <?php if ($user['department_id'] == $dept['id']) echo "selected"; ?>>

                                        <?php echo $dept['name']; ?>

                                    </option>

                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <!-- PHONE -->
                    <div class="col-md-4">
                        <label>Phone</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-phone"></i>
                            <input type="text" name="phone"
                                value="<?php echo $user['phone']; ?>"
                                class="form-control">
                        </div>
                    </div>

                    <!-- GENDER -->
                    <div class="col-md-4">
                        <label>Gender</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-venus-mars"></i>

                            <select name="gender" class="form-control form-select">
                                <option value="male" <?php if ($user['gender'] == "male") echo "selected"; ?>>Male</option>
                                <option value="female" <?php if ($user['gender'] == "female") echo "selected"; ?>>Female</option>
                                <option value="other" <?php if ($user['gender'] == "other") echo "selected"; ?>>Other</option>
                            </select>

                        </div>
                    </div>

                    <!-- DOB -->
                    <div class="col-md-4">
                        <label>DOB</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-calendar"></i>
                            <input type="date" name="dob"
                                value="<?php echo $user['dob']; ?>"
                                class="form-control">
                        </div>
                    </div>

                    <!-- ROLE -->
                    <div class="col-md-4">
                        <label>Role</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-user-shield"></i>
                            <input type="text"
                                value="<?php echo ucfirst($user['role']); ?>"
                                class="form-control" readonly>
                        </div>
                    </div>

                    <!-- JOIN DATE -->
                    <div class="col-md-4">
                        <label>Joined</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-clock"></i>
                            <input type="text"
                                value="<?php echo date("d M Y", strtotime($user['created_at'])); ?>"
                                class="form-control" readonly>
                        </div>
                    </div>

                    <!-- ADDRESS -->
                    <div class="col-md-6">
                        <label>Address</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-location-dot"></i>
                            <textarea name="address" class="form-control" rows="4"><?php echo $user['address']; ?></textarea>
                        </div>
                    </div>

                    <!-- PHOTO -->
                    <div class="col-md-6">
                        <label>Profile Photo</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-image"></i>
                            <input type="file" name="photo" class="form-control">
                        </div>
                    </div>

                </div>

                <button type="submit" name="update" class="btn btn-success mt-3">
                    Update Profile
                </button>

            </form>

            <?php
            if (isset($_POST['update'])) {

                $name = $_POST['name'];
                $email = $_POST['email'];
                $employee_id = $_POST['employee_id'];
                $department_id = $_POST['department_id'];
                $phone = $_POST['phone'];
                $gender = $_POST['gender'];
                $dob = $_POST['dob'];
                $address = $_POST['address'];

                $photo = $user['photo'];

                if ($_FILES['photo']['name'] != "") {
                    $photo = time() . "_" . $_FILES['photo']['name'];
                    move_uploaded_file($_FILES['photo']['tmp_name'], "../uploads/" . $photo);
                }

                mysqli_query($conn, "
UPDATE users SET
name='$name',
email='$email',
employee_id='$employee_id',
department_id='$department_id',
phone='$phone',
gender='$gender',
dob='$dob',
address='$address',
photo='$photo'
WHERE id='$id'
");

                echo "<script>
alert('Profile Updated Successfully');
window.location.href='';
</script>";
            }
            ?>

        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>