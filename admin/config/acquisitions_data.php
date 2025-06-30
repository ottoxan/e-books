<?php

session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require "database.php";

    // Fetch user data
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Count books grouped by academic stage
    $sqlEbooks = "
        SELECT 
            academic_stage.academic_stage,
            COUNT(ebooks.id) AS book_count
        FROM ebooks
        LEFT JOIN academic_stage ON ebooks.academic_id = academic_stage.id
        GROUP BY academic_stage.academic_stage
    ";
    $resultEbooks = $mysqli->query($sqlEbooks);

    if (!$resultEbooks) {
        die("Database query failed: " . $mysqli->error);
    }
}

$data = [
    'labels' => [],
    'data' => []
];

while ($row = $resultEbooks->fetch_assoc()) {
    $data['labels'][] = $row['academic_stage'] ?? 'Unknown';
    $data['data'][] = (int)$row['book_count'];
}

echo json_encode($data);
