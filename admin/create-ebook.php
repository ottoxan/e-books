<?php require 'ebook-function.php'; ?>
<?php include 'partials/header.php'; ?>

<?php
$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_title = $_POST['book_title'] ?? '';
    $academic_id = $_POST['stage'] ?? '';
    $grade_id = $_POST['grade'] ?? '';
    $semester_id = $_POST['semester'] ?? '';
    $subject_id = $_POST['subject'] ?? '';
    $file_cover = $_FILES['file_cover'] ?? null;
    $book_file = $_FILES['book_file'] ?? null;

    // Validate inputs
    if (empty($book_title)) {
        $error_message = "Book title is required.";
    } elseif (empty($academic_id)) {
        $error_message = "Academic stage is required.";
    } elseif (empty($grade_id)) {
        $error_message = "Grade is required.";
    } elseif (empty($semester_id)) {
        $error_message = "Semester is required.";
    } elseif (empty($subject_id)) {
        $error_message = "Subject is required.";
    } elseif (empty($book_file) || $book_file['error'] !== UPLOAD_ERR_OK) {
        $error_message = "Book file (PDF) is required.";
    } else {
        // Handle file uploads
        $upload_dir = '../uploads/ebooks/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Upload file cover (optional)
        $file_cover_name = null;
        if (!empty($file_cover) && $file_cover['error'] === UPLOAD_ERR_OK) {
            $file_cover_name = basename($file_cover['name']);
            move_uploaded_file($file_cover['tmp_name'], $upload_dir . $file_cover_name);
        }

        // Upload book file (required)
        $book_file_name = basename($book_file['name']);
        if (move_uploaded_file($book_file['tmp_name'], $upload_dir . $book_file_name)) {
            // Insert into database
            $mysqli = require "config/database.php";
            $stmt = $mysqli->prepare("INSERT INTO ebooks (academic_id, grade_id, semester_id, subject_id, book_file_name, book_title, file_cover) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iiissss", $academic_id, $grade_id, $semester_id, $subject_id, $book_file_name, $book_title, $file_cover_name);

            if ($stmt->execute()) {
                $success_message = "Ebook created successfully.";
                header("Location: ebooks.php?success_message=" . urlencode($success_message));
                exit;
            } else {
                $error_message = "Error: " . $stmt->error;
            }
        } else {
            $error_message = "Failed to upload the book file.";
        }
    }
}
?>

<div class="form-popup-bg is-visible">
    <div class="form-container">
        <?php if (!empty($error_message)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php } ?>
        <?php if (!empty($success_message)) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success_message; ?>
            </div>
        <?php } ?>

        <form name="ebook-form" method="POST" enctype="multipart/form-data">
            <h1>Create Ebook</h1>
            <div class="form-group">
                <label for="book_title">Book Title</label>
                <input type="text" class="form-control" id="book_title" name="book_title" value="">
            </div>
            <div class="form-group">
                <label>Academic Stage</label>
                <select class="form-select mb-3" onchange="getGrade(this.value)" name="stage" aria-label="Default select example">
                    <option selected disabled>Select an Academic Stage</option>
                    <?php
                    $stage = getStage();
                    foreach ($stage as $stage) {
                    ?>
                        <option value="<?php echo $stage['id']; ?>">
                            <?php echo $stage['academic_stage']; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Grade</label>
                <select disabled class="form-select mb-3" onchange="getSemester(this.value)" name="grade" aria-label="Default select example">
                    <option selected disabled>Select a grade</option>
                </select>
            </div>

            <div class="form-group">
                <label>Semester</label>
                <select disabled class="form-select mb-3" onchange="getSubject(this.value)" name="semester" aria-label="Default select example">
                    <option selected disabled>Select a semester</option>
                </select>
            </div>

            <div class="form-group">
                <label>Subject</label>
                <select id="subject-dropdown" disabled class="form-select mb-3" name="subject" aria-label="Default select example">
                    <option selected disabled>Select a subject</option>
                </select>
            </div>
            <div class="form-group">
                <label for="file_cover">File Cover</label>
                <input type="file" class="form-control" id="file_cover" name="file_cover" accept="image/*">
            </div>
            <div class="form-group">
                <label for="book_file">Book File (PDF)</label>
                <input type="file" class="form-control" id="book_file" name="book_file" accept=".pdf">
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="ebooks.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="js/dynamic.js"></script>

<?php include 'partials/footer.php'; ?>