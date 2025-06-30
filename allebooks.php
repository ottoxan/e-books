<?php
require "lang.php";

$mysqli = require "admin/config/database.php";

// --- Pagination setup ---
$perPage = 4;
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
?>
    
<section id="ebooks-section" class="d-flex py-0 flex-column pt-5">
    <div class="container">
        <div class="section-header">
            <h2 class="">
                <?= __(' All Books') ?>
            </h2>
            <p>A book is a medium of information containing writing or images, used to convey knowledge, stories, or ideas. Books can be in print or digital form, and play an important role in education, entertainment, and self-development.</p>
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

        <!-- Bootstrap Pagination -->
        <?php if ($totalPages > 1): ?>
            <nav aria-label="Ebooks pagination" class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item<?php if ($page <= 1) echo ' disabled'; ?>">
                        <a class="page-link" href="?page=1#ebooks-section">&laquo;</a>
                    </li>
                    <li class="page-item<?php if ($page <= 1) echo ' disabled'; ?>">
                        <a class="page-link" href="?page=<?php echo max(1, $page - 1); ?>#ebooks-section">&lt;</a>
                    </li>
                    <?php
                    // Show up to 5 page links
                    $start = max(1, $page - 2);
                    $end = min($totalPages, $page + 2);
                    for ($i = $start; $i <= $end; $i++): ?>
                        <li class="page-item<?php if ($i == $page) echo ' active'; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>#ebooks-section"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item<?php if ($page >= $totalPages) echo ' disabled'; ?>">
                        <a class="page-link" href="?page=<?php echo min($totalPages, $page + 1); ?>#ebooks-section">&gt;</a>
                    </li>
                    <li class="page-item<?php if ($page >= $totalPages) echo ' disabled'; ?>">
                        <a class="page-link" href="?page=<?php echo $totalPages; ?>#ebooks-section">&raquo;</a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</section>