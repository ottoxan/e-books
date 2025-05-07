<?php

session_start();
$mysqli = require "admin/config/database.php";

// Get the 'id' parameter from the URL
$id = $_GET['id'] ?? null;

if ($id) {
    // Sanitize the input
    $id = intval($id);

    // Fetch data based on the 'id'
    $sqlEbook = "SELECT 
            ebooks.id,
            ebooks.book_title,
            ebooks.book_file_name,
            ebooks.file_cover,
            academic_stage.academic_stage,
            grade.grade,
            semester.semester_number,
            subject.subject
        FROM ebooks
        LEFT JOIN academic_stage ON ebooks.academic_id = academic_stage.id
        LEFT JOIN grade ON ebooks.grade_id = grade.id
        LEFT JOIN semester ON ebooks.semester_id = semester.id
        LEFT JOIN subject ON ebooks.subject_id = subject.id
        WHERE subject_id = ?";
    $stmt = $mysqli->prepare($sqlEbook);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultEbook = $stmt->get_result();

    if (!$resultEbook) {
        die("Database query failed: " . $mysqli->error);
    }
} else {
    die("No ID provided in the URL.");
}

$ebooks = []; // Initialize an empty array to store the data

while ($row = $resultEbook->fetch_assoc()) {
    $ebooks[] = $row; // Store each row in the array
}

?>

<?php include "partials/header.php" ?>
        <!-- Section -->
        <main class="content">
            <section class="hero-section">
                <h2 class="section-title">Ebooks</h2>
                <div class="projects-grid">
                    <?php if (!empty($ebooks)): ?>
                        <?php foreach ($ebooks as $ebook): ?>
                            <div class="project-card" onclick="showPdfModal('<?php echo 'uploads/ebooks/' . htmlspecialchars($ebook['book_file_name']); ?>')">
                                <img src="uploads/ebooks/<?php echo htmlspecialchars($ebook["file_cover"] ?? 'default-cover.jpg'); ?>" class="card-image" alt="<?php echo htmlspecialchars($ebook["book_title"]); ?>">
                                <h3><?php echo htmlspecialchars($ebook["book_title"]); ?></h3>
                                <div class="btn-grup">
                                    <a href="#" class="btn">View PDF</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No ebooks available for this subject.</p>
                    <?php endif; ?>
                </div>
                <?php if (!empty($ebooks)): ?>
                    <div class="pt-5">
                        <h3>Book Name: <?php echo htmlspecialchars($ebooks[0]['book_title']); ?></h3>
                    </div>
                    <div class="pt-5">
                        <h3>Grade: <?php echo htmlspecialchars($ebooks[0]['grade']); ?></h3>
                    </div>
                    <div class="pt-5">
                        <h3>Semester: <?php echo htmlspecialchars($ebooks[0]['semester_number']); ?></h3>
                    </div>
                    <div class="pt-5">
                        <h3>Academic Stage: <?php echo htmlspecialchars($ebooks[0]['academic_stage']); ?></h3>
                    </div>
                <?php endif; ?>
            </section>
        </main>
        <!-- End Section -->

        <!-- PDF Modal -->
        <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pdfModalLabel">Ebook Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <iframe id="pdfViewer" src="" width="100%" height="600px" style="border: none;"></iframe>
                    </div>
                </div>
            </div>
        </div>

<?php include "partials/footer.php" ?>

<script>
    function showPdfModal(pdfUrl) {
        const pdfViewer = document.getElementById('pdfViewer');
        pdfViewer.src = pdfUrl; // Set the PDF file URL
        const pdfModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('pdfModal'));
        pdfModal.show(); // Show the modal
    }
</script>