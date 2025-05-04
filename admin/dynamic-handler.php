<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    die("Unauthorized access.");
}

$mysqli = require "config/database.php";

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action === 'getGrades' && isset($_GET['stage_id'])) {
        $stage_id = intval($_GET['stage_id']);
        $sql = "SELECT id, grade FROM grade WHERE academic_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $stage_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $grades = [];
        while ($row = $result->fetch_assoc()) {
            $grades[] = $row;
        }
        echo json_encode($grades);
        exit;
    }

    if ($action === 'getSemesters' && isset($_GET['grade_id'])) {
        $grade_id = intval($_GET['grade_id']);
        $sql = "SELECT id, semester_number FROM semester WHERE grade_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $grade_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $semesters = [];
        while ($row = $result->fetch_assoc()) {
            $semesters[] = $row;
        }
        echo json_encode($semesters);
        exit;
    }

    if ($action === 'getSubjects' && isset($_GET['semester_id'])) {
        $semester_id = intval($_GET['semester_id']);
        $sql = "SELECT id, subject FROM subject WHERE semester_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $semester_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $subjects = [];
        while ($row = $result->fetch_assoc()) {
            $subjects[] = $row;
        }
        echo json_encode($subjects);
        exit;
    }
}
