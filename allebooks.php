<?php
require "lang.php";

$mysqli = require "admin/config/database.php";

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
        LEFT JOIN subject ON ebooks.subject_id = subject.id";

$stmt = $mysqli->prepare($sqlEbook);
$stmt->execute();
$resultEbook = $stmt->get_result();

if (!$resultEbook) {
    die("Database query failed: " . $mysqli->error);
}


$ebooks = []; // Initialize an empty array to store the data

while ($row = $resultEbook->fetch_assoc()) {
    $ebooks[] = $row; // Store each row in the array
}

?>

<section class="d-flex py-0 flex-column pt-5">
    <div class="container">
        <div class="section-header">
            <h2 class="">
                <?= __('Other books') ?>
            </h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, sit.</p>
        </div>

        <div class="d-flex flex-wrap justify-content-center">
            <?php if (!empty($ebooks)): ?>
                <?php foreach ($ebooks as $ebook): ?>
                    <div class="card book-card" onclick="location.href='ebook.php?id=<?php echo $ebook['id']; ?>'">
                        <img src="uploads/ebooks/<?php echo htmlspecialchars($ebook["file_cover"] ?? 'default-cover.jpg'); ?>" alt="<?php echo htmlspecialchars($ebook["book_title"]); ?>" class="book-image">
                        <div class="card-body">
                            <div class="mb-2">
                                <span class="badge bg-danger">PDF</span>
                                <span class="badge bg-primary"><?php echo htmlspecialchars($ebook['grade']); ?></span>
                                <span class="badge bg-primary"><?php echo htmlspecialchars($ebook['semester_number']); ?></span>
                            </div>
                            <h5 class="card-title"><?php echo htmlspecialchars($ebook["book_title"]); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($ebook['academic_stage']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p><?= __('No ebooks available.') ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>