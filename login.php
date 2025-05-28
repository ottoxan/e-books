<?php
require "lang.php";

$is_invalid = false;


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require "admin/config/database.php";

    $sql = sprintf("SELECT * FROM user WHERE email = '%s'", $_POST['email']);
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();


    if ($user) {
        if (password_verify($_POST['password'], $user['password_hash'])) {

            session_start();

            session_regenerate_id(); // Prevent session fixation attacks
            $_SESSION["user_id"] = $user["id"];
            header("Location: admin/dashboard.php");
            exit;
        }
    }

    $is_invalid = true;
};

?>

<?php include "partials/header.php" ?>



<main class="login-div d-flex justify-content-center align-items-center flex-column">
    <div class="title">Ebooks</div>
    <div class="sub-title">Login</div>

    <?php if ($is_invalid): ?>
        <em class="text-danger"> Invalid Login</em>
    <?php endif; ?>

    <form method="POST" class="form">

        <div class="username">
            <input placeholder="Email" class="text-white" type="text" id="email" name="email" value="<?php htmlspecialchars($_POST["email"] ?? "") ?>" required>
        </div>

        <div class="password">
            <input type="password" id="password" name="password" placeholder="Password" class="text-white">
        </div>
        <div class="d-flex justify-content-center">
            <button class="signin-btn">LOGIN</button>
        </div>
    </form>
</main>

<?php include "partials/footer.php" ?>