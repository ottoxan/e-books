<?php

session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require "config/database.php";
    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}
?>

<?php if (isset($user)): ?>

    <?php include 'partials/header.php' ?>

    <!-- MAIN -->
    <main id="content-main">
        <?php include "home.php" ?>
    </main>


    <?php include 'partials/footer.php' ?>

<?php else: ?>
    <p>You are not logged in. <a href="login.php">Login</a></p>
<?php endif; ?>