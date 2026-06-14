<div class="topbar d-flex justify-content-between align-items-center p-3 shadow-sm rounded">

    <!-- Title -->
    <div>
        <h3 class="m-0 fw-bold" style="color: #4951a8;">
            Factory ERP System
        </h3>
    </div>


    <div class="d-flex align-items-center">

        <?php

        $user_id = $_SESSION['id'];

        // Notification Count
        $count_query = mysqli_query(
            $conn,
            "
            SELECT COUNT(*) AS total
            FROM notifications
            WHERE user_id='$user_id'
            AND is_read='0'
            "
        );

        $count_data =
            mysqli_fetch_assoc(
                $count_query
            );

        $notification_count =
            $count_data['total'];



        // Latest Notifications
        $ntf = mysqli_query(
            $conn,
            "
            SELECT *
            FROM notifications
            WHERE user_id='$user_id'
            ORDER BY id DESC
            LIMIT 5
            "
        );

        ?>


        <!-- Notification Dropdown -->
        <div class="dropdown me-3 position-relative">

            <button
                class="btn btn-light shadow-sm border position-relative rounded-circle"
                style="width:50px;height:50px;"
                data-bs-toggle="dropdown">

                <i class="fas fa-bell fs-5"></i>

                <?php
                if (
                    $notification_count > 0
                ) {
                ?>

                    <span
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">

                        <?php
                        echo $notification_count;
                        ?>

                    </span>

                <?php } ?>

            </button>



            <!-- Notification Popup -->
            <ul class="dropdown-menu dropdown-menu-end notification-dropdown shadow border-0">

                <li class="dropdown-header fw-bold text-primary fs-6">

                    <i class="fas fa-bell me-2"></i>
                    Notifications

                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>


                <?php

                if (
                    mysqli_num_rows(
                        $ntf
                    ) > 0
                ) {

                    while (
                        $n =
                        mysqli_fetch_assoc(
                            $ntf
                        )
                    ) {

                ?>

                        <li>

                            <a href="#"
                                class="dropdown-item py-3 border-bottom <?php echo ($n['is_read'] == 0) ? 'bg-light' : ''; ?>">

                                <div class="fw-semibold text-dark">

                                    <?php
                                    echo $n['message'];
                                    ?>

                                </div>

                                <small class="text-muted">

                                    <i class="fas fa-clock me-1"></i>

                                    <?php
                                    echo date(
                                        "d M Y h:i A",
                                        strtotime(
                                            $n['created_at']
                                        )
                                    );
                                    ?>

                                </small>

                            </a>

                        </li>

                    <?php
                    }
                } else {
                    ?>

                    <li
                        class="text-center text-muted py-4">

                        <i class="fas fa-bell-slash fs-3 mb-2 d-block"></i>

                        No notifications found

                    </li>

                <?php } ?>

            </ul>

        </div>



        <!-- Profile Dropdown -->
        <div class="dropdown">

            <button
                class="btn btn-dark dropdown-toggle px-3 py-2 shadow-sm rounded-pill"
                data-bs-toggle="dropdown">

                <i class="fas fa-user-circle me-2"></i>

                <?php
                echo $_SESSION['name'];
                ?>

            </button>

            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4">

                <li>

                    <a class="dropdown-item py-2"
                        href="#">

                        <i class="fas fa-user me-2 text-primary"></i>

                        Profile

                    </a>

                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>

                    <a class="dropdown-item text-danger py-2"
                        href="../logout.php">

                        <i class="fas fa-sign-out-alt me-2"></i>

                        Logout

                    </a>

                </li>

            </ul>

        </div>

    </div>

</div>