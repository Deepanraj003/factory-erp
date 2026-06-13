<div class="topbar d-flex justify-content-between align-items-center">

    <div>
        <h5 class="m-0">Factory ERP System</h5>
    </div>

    <div>
        <?php
        $user_id = $_SESSION['id'];

        $ntf = mysqli_query($conn, "SELECT * FROM notifications 
        WHERE user_id='$user_id' 
        ORDER BY id DESC LIMIT 5");
        ?>

        <div class="dropdown d-inline me-3">
            <button class="btn btn-light btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                🔔 Notifications
            </button>

            <ul class="dropdown-menu dropdown-menu-end">

                <?php while ($n = mysqli_fetch_assoc($ntf)) { ?>
                    <li class="dropdown-item">
                        <?php echo $n['message']; ?>
                    </li>
                <?php } ?>

            </ul>
        </div>

        <div class="dropdown d-inline">
            <a class="btn btn-sm btn-dark dropdown-toggle" data-bs-toggle="dropdown">
                <?php echo $_SESSION['name']; ?>
            </a>

            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
            </ul>
        </div>
    </div>

</div>