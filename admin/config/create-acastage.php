<?php

include 'config/check-connection.php';
$mysqli = require "config/database.php";


$academic_stage = '';
$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate the input data
    $academic_stage = $_POST["academic_stage"];

    do {
        if (empty($academic_stage)) {
            $error_message = "Academic stage is required";
            break;
        }

        $sql = "INSERT INTO academic_stage (academic_stage)" .
            "VALUES ('$academic_stage')";
        $result = $mysqli->query($sql);

        if (!$result) {
            $error_message = "Error: " . $mysqli->error;
            break;
        }

        $academic_stage = '';

        $success_message = "Academic stage created successfully";

        echo "<script>loadContent('views/academic_stage.php');</script>";
        exit;
    } while (false);
}
