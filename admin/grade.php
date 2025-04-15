<?php

session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require "../config/database.php";
    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="css/dashboard.css">

    <title>Dashboard</title>
</head>

<body>
    <?php if (isset($user)): ?>
        <?php include "partials/sidebar.php"; ?>


        <!-- CONTENT -->
        <section id="content">
            <?php include "partials/navbar.php"; ?>

            <!-- MAIN -->
            <main>
                <div class="head-title">
                    <div class="left">
                        <h1>Dashboard</h1>
                        <ul class="breadcrumb">
                            <li>
                                <a href="#">Dashboard</a>
                            </li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li>
                                <a class="active" href="#">Home</a>
                            </li>
                        </ul>
                    </div>
                    <a href="#" class="btn-download">
                        <i class='bx bxs-cloud-download'></i>
                        <span class="text">Download PDF</span>
                    </a>
                </div>


                <div class="table-data">
                    <div class="order">
                        <div class="head">
                            <h3>Recent Orders</h3>
                            <i class='bx bx-search'></i>
                            <i class='bx bx-filter'></i>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Academic Stages</th>
                                    <th>Academic Code</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Stage 6
                                    </td>
                                    <td>SA6</td>
                                    <td>
                                        <a href="#" class="btn-primary m-1 p-1 rounded-2">
                                            <span class="text">Edit</span>
                                        </a>
                                        <a href="#" class="btn-danger p-1 rounded-2">
                                            <span class="text">Delete</span>
                                        </a>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Stage 1
                                    </td>
                                    <td>SA1</td>
                                    <td>
                                        <a href="#" class="btn-primary m-1 p-1 rounded-2">
                                            <span class="text">Edit</span>
                                        </a>
                                        <a href="#" class="btn-danger p-1 rounded-2">
                                            <span class="text">Delete</span>
                                        </a>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Stage 2
                                    </td>
                                    <td>SA2</td>
                                    <td>
                                        <a href="#" class="btn-primary m-1 p-1 rounded-2">
                                            <span class="text">Edit</span>
                                        </a>
                                        <a href="#" class="btn-danger p-1 rounded-2">
                                            <span class="text">Delete</span>
                                        </a>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
            <!-- MAIN -->
        </section>
        <!-- CONTENT -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
        <script src="../js/script.js"></script>
    <?php else: ?>
        <p>You are not logged in. <a href="login.php">Login</a></p>
    <?php endif; ?>

</body>

</html>