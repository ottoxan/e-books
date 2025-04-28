<?php

$is_invalid = false;


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require "config/database.php";

    $sql = sprintf("SELECT * FROM user WHERE email = '%s'", $_POST['email']);
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();


    if ($user) {
        if (password_verify($_POST['password'], $user['password_hash'])) {

            session_start();

            session_regenerate_id(); // Prevent session fixation attacks
            $_SESSION["user_id"] = $user["id"];
            header("Location: dashboard.php");
            exit;
        }
    }

    $is_invalid = true;
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="css/login.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->


</head>

<body>
    <div>
        <h1 class="">Login</h1>

        <?php if ($is_invalid): ?>
            <em> Invalid Login</em>
        <?php endif; ?>

        <form method="POST">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php htmlspecialchars($_POST["email"] ?? "") ?>" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <button>Login</button>
    </div>
</body>

</html>