<?php
require "lang.php";

$mysqli = require "admin/config/database.php";

// Get search query from URL (?q=...)
$search = $_GET['q'] ?? '';

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
        WHERE 1";

$params = [];
$types = '';

if ($search !== '') {
    $sqlEbook .= " AND (ebooks.book_title LIKE ? OR grade.grade LIKE ? OR semester.semester_number LIKE ? OR academic_stage.academic_stage LIKE ?)";
    $params[] = '%' . $search . '%';
    $params[] = '%' . $search . '%';
    $params[] = '%' . $search . '%';
    $params[] = '%' . $search . '%';
    $types .= 'ssss';
}

$stmt = $mysqli->prepare($sqlEbook);

if ($types) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$resultEbook = $stmt->get_result();

if (!$resultEbook) {
    die("Database query failed: " . $mysqli->error);
}

$ebooks = [];
while ($row = $resultEbook->fetch_assoc()) {
    $ebooks[] = $row;
}
?>

<?php include "partials/header.php" ?>


<section class="d-flex flex-column">
    <h1 class="pb-3">Book Search</h1>
    <form class="mb-4" method="get" action="">
        <div class="input-group" style="max-width:400px;">
            <input type="text" class="form-control" name="q" placeholder="Search book title..." value="<?php echo htmlspecialchars($search); ?>">
            <button class="btn btn-primary" type="submit"><?= __('Search') ?></button>
        </div>
    </form>

    <div class="d-flex flex-wrap">
        <?php if (!empty($ebooks)): ?>
            <?php foreach ($ebooks as $ebook): ?>
                <div class="card book-card m-lg-5" onclick="location.href='ebook.php?id=<?php echo $ebook['id']; ?>'">
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
</section>

<?php include "partials/footer.php" ?>