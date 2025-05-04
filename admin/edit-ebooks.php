<?php

$mysqli = require "config/database.php";

$book_title = '';
$academic_id = '';
$grade_id = '';
$semester_id = '';
$subject_id = '';
$book_file_name = '';
$error_message = '';
$success_message = '';

// Fetch dropdown data for academic stages, grades, semesters, and subjects
$sqlAcademicStages = "SELECT id, academic_stage FROM academic_stage";
$resultAcademicStages = $mysqli->query($sqlAcademicStages);

$sqlGrades = "SELECT id, grade FROM grade";
$resultGrades = $mysqli->query($sqlGrades);

$sqlSemesters = "
    SELECT 
        semester.id AS semester_id, 
        semester.semester_number, 
        grade.grade, 
        academic_stage.academic_stage 
    FROM semester
    JOIN grade ON semester.grade_id = grade.id
    JOIN academic_stage ON grade.academic_id = academic_stage.id
";
$resultSemesters = $mysqli->query($sqlSemesters);

$sqlSubjects = "SELECT id, subject FROM subject";
$resultSubjects = $mysqli->query($sqlSubjects);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if the `id` parameter is provided
    if (!isset($_GET['id'])) {
        header("Location: ebooks.php?error_message=" . urlencode("Ebook ID is required"));
        exit;
    }

    $id = $_GET['id'];

    // Fetch the ebook data for the given ID
    $sql = "SELECT * FROM ebooks WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: ebooks.php?error_message=" . urlencode("Ebook not found"));
        exit;
    }

    // Populate the form with the existing data
    $book_title = $row['book_title'];
    $academic_id = $row['academic_id'];
    $grade_id = $row['grade_id'];
    $semester_id = $row['semester_id'];
    $subject_id = $row['subject_id'];
    $book_file_name = $row['book_file_name'];
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission for updating the ebook
    $id = $_POST['id']; // Retrieve the ID from the hidden input field
    $book_title = $_POST['book_title'] ?? '';
    $academic_id = $_POST['academic_id'] ?? '';
    $grade_id = $_POST['grade_id'] ?? '';
    $semester_id = $_POST['semester_id'] ?? '';
    $subject_id = $_POST['subject_id'] ?? '';
    $new_file_name = $_FILES['book_file_name']['name'] ?? '';

    // Validate input
    if (empty($book_title)) {
        $error_message = "Book title is required";
    } elseif (empty($academic_id)) {
        $error_message = "Academic stage is required";
    } elseif (empty($grade_id)) {
        $error_message = "Grade is required";
    } elseif (empty($semester_id)) {
        $error_message = "Semester is required";
    } elseif (empty($subject_id)) {
        $error_message = "Subject is required";
    } else {
        // Handle file upload if a new file is provided
        if (!empty($new_file_name)) {
            $upload_dir = 'uploads/ebooks/';
            $target_file = $upload_dir . basename($new_file_name);

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            if (move_uploaded_file($_FILES['book_file_name']['tmp_name'], $target_file)) {
                $book_file_name = $new_file_name;
            } else {
                $error_message = "Failed to upload the file.";
            }
        }

        if (empty($error_message)) {
            // Update the database
            $sql = "UPDATE ebooks SET academic_id = ?, grade_id = ?, semester_id = ?, subject_id = ?, book_title = ?, book_file_name = ? WHERE id = ?";
            $stmt = $mysqli->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("iiisssi", $academic_id, $grade_id, $semester_id, $subject_id, $book_title, $book_file_name, $id);
                if ($stmt->execute()) {
                    $success_message = "Ebook updated successfully";
                    header("Location: ebooks.php?success_message=" . urlencode($success_message));
                    exit;
                } else {
                    $error_message = "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $error_message = "Error: " . $mysqli->error;
            }
        }
    }
}
?>

<?php include 'partials/header.php' ?>

<?php if (!empty($success_message)) { ?>
    <div class="alert alert-success" role="alert">
        <?php echo $success_message; ?>
    </div>
<?php } ?>
<div class="form-popup-bg is-visible">
    <div class="form-container">
        <?php if (!empty($error_message)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php } ?>

        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id'] ?? ''); ?>">
            <h1>Edit Ebook</h1>
            <div class="form-group">
                <label for="book_title">Book Title</label>
                <input type="text" class="form-control" id="book_title" name="book_title" value="<?php echo htmlspecialchars($book_title); ?>">
            </div>
            <div class="form-group">
                <label for="academic_id">Academic Stage</label>
                <select class="form-select mb-3" id="academic_id" name="academic_id">
                    <option selected disabled>Select an academic stage</option>
                    <?php while ($row = $resultAcademicStages->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($row["id"]); ?>" <?php echo $row["id"] == $academic_id ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($row["academic_stage"]); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="grade_id">Grade</label>
                <select class="form-select mb-3" id="grade_id" name="grade_id">
                    <option selected disabled>Select a grade</option>
                    <?php while ($row = $resultGrades->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($row["id"]); ?>" <?php echo $row["id"] == $grade_id ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($row["grade"]); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="semester_id">Semester</label>
                <select class="form-select mb-3" id="semester_id" name="semester_id">
                    <option selected disabled>Select a semester</option>
                    <?php while ($row = $resultSemesters->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($row["semester_id"]); ?>" <?php echo $row["semester_id"] == $semester_id ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars("Semester " . $row["semester_number"] . " - " . $row["grade"] . " (" . $row["academic_stage"] . ")"); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="subject_id">Subject</label>
                <select class="form-select mb-3" id="subject_id" name="subject_id">
                    <option selected disabled>Select a subject</option>
                    <?php while ($row = $resultSubjects->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($row["id"]); ?>" <?php echo $row["id"] == $subject_id ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($row["subject"]); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="book_file_name">Book File (PDF)</label>
                <input type="file" class="form-control" id="book_file_name" name="book_file_name" accept=".pdf">
                <?php if (!empty($book_file_name)): ?>
                    <small>Current file: <a href="uploads/ebooks/<?php echo htmlspecialchars($book_file_name); ?>" target="_blank"><?php echo htmlspecialchars($book_file_name); ?></a></small>
                <?php endif; ?>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="ebooks.php" role='button'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'partials/footer.php' ?>