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
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
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
            <main id="content-main">
                <script>
                    loadContent('views/home.php')
                </script>
            </main>
            <!-- MAIN -->
        </section>
        <!-- CONTENT -->

        <script src="../js/script.js"></script>
    <?php else: ?>
        <p>You are not logged in. <a href="login.php">Login</a></p>
    <?php endif; ?>

</body>

</html>