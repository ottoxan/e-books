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
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">


</head>

<body>

    <div class="login-div d-flex justify-content-center align-items-center flex-column">
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
    </div>

</body>

</html>