<?php

session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require "config/database.php";
    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}
?>