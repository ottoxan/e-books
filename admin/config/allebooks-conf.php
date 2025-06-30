<?php
require "../lang.php";

$mysqli = require "database.php";


// --- Pagination setup ---
$perPage = 3;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;

// Get total count
$countResult = $mysqli->query("SELECT COUNT(*) as total FROM ebooks");
$totalBooks = $countResult ? (int)$countResult->fetch_assoc()['total'] : 0;
$totalPages = ceil($totalBooks / $perPage);

// Main query with LIMIT
$sqlEbook = "SELECT 
            ebooks.id,
            ebooks.book_title,
            ebooks.book_file_name,
            ebooks.file_cover,
            academic_stage.academic_stage,
            grade.grade,
            semester.semester_number,
            subject.subject,
            subject.id
        FROM ebooks
        LEFT JOIN academic_stage ON ebooks.academic_id = academic_stage.id
        LEFT JOIN grade ON ebooks.grade_id = grade.id
        LEFT JOIN semester ON ebooks.semester_id = semester.id
        LEFT JOIN subject ON ebooks.subject_id = subject.id
        LIMIT ?, ?";
$stmt = $mysqli->prepare($sqlEbook);
$stmt->bind_param("ii", $offset, $perPage);
$stmt->execute();
$resultEbook = $stmt->get_result();

if (!$resultEbook) {
    die("Database query failed: " . $mysqli->error);
}

$ebooks = [];
while ($row = $resultEbook->fetch_assoc()) {
    $ebooks[] = $row;
}
