<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar_staff.php"); ?>
<?php include("../includes/navbar.php"); ?>

<?php
$id = $_SESSION['id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id='$id'"));
?>

<div class="main-content">

    <div class="container-fluid">

        <h3>My Profile</h3>

        <div class="card-box">

            <form method="POST">

                <div class="row">

                    <div class="col-md-4">
                        <label>Name</label>
                        <input type="text" name="name" value="<?php echo $user['name']; ?>" class="form-control mb-2">
                    </div>

                    <div class="col-md-4">
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo $user['email']; ?>" class="form-control mb-2">
                    </div>

                    <div class="col-md-4">
                        <label>Employee ID</label>
                        <input type="text" name="employee_id" value="<?php echo $user['employee_id']; ?>" class="form-control mb-2">
                    </div>

                    <div class="col-md-4">
                        <label>Phone</label>
                        <input type="text" name="phone" value="<?php echo $user['phone']; ?>" class="form-control mb-2">
                    </div>

                    <div class="col-md-4">
                        <label>Gender</label>
                        <select name="gender" class="form-control mb-2">
                            <option <?php if ($user['gender'] == "Male") echo "selected"; ?>>Male</option>
                            <option <?php if ($user['gender'] == "Female") echo "selected"; ?>>Female</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" value="<?php echo $user['dob']; ?>" class="form-control mb-2">
                    </div>

                    <div class="col-md-4">
                        <label>Address</label>
                        <textarea name="address" class="form-control mb-2"><?php echo $user['address']; ?></textarea>
                    </div>

                </div>

                <button name="update" class="btn btn-success mt-3">Update Profile</button>

            </form>

            <?php
            if (isset($_POST['update'])) {

                $name = $_POST['name'];
                $email = $_POST['email'];
                $emp = $_POST['employee_id'];
                $phone = $_POST['phone'];
                $gender = $_POST['gender'];
                $dob = $_POST['dob'];
                $address = $_POST['address'];

                mysqli_query($conn, "UPDATE users SET 
                    name='$name',
                    email='$email',
                    employee_id='$emp',
                    phone='$phone',
                    gender='$gender',
                    dob='$dob',
                    address='$address'
                    WHERE id='$id'");

                echo "<script>alert('Profile Updated Successfully');</script>";
            }
            ?>

        </div>

    </div>

</div>

<?php include("../includes/footer.php"); ?>