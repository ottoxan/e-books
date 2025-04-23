<?php

if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];

    include "config/database.php";

    // Define the table and redirect URL based on the type
    $table = '';
    $redirect_url = '';

    switch ($type) {
        case 'subject':
            $table = 'subject';
            $redirect_url = 'subject.php';
            $success_message = "Subject deleted successfully";
            break;
        case 'grade':
            $table = 'grade';
            $redirect_url = 'grade.php';
            $success_message = "Grade deleted successfully";
            break;
        case 'semester':
            $table = 'semester';
            $redirect_url = 'semester.php';
            $success_message = "Semester deleted successfully";
            break;
        case 'academic_stage':
            $table = 'academic_stage';
            $redirect_url = 'academic_stage.php';
            $success_message = "Academic stage deleted successfully";
            break;
        default:
            header("Location: index.php?error_message=" . urlencode("Invalid delete type"));
            exit;
    }

    // Execute the delete query
    $sql = "DELETE FROM $table WHERE id = ?";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            header("Location: $redirect_url?success_message=" . urlencode($success_message));
            exit;
        } else {
            header("Location: $redirect_url?error_message=" . urlencode("Error: " . $stmt->error));
            exit;
        }
    } else {
        header("Location: $redirect_url?error_message=" . urlencode("Error: " . $mysqli->error));
        exit;
    }
} else {
    header("Location: index.php?error_message=" . urlencode("Invalid request"));
    exit;
}
