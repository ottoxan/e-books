<?php

$mysqli = require "config/database.php";

$subject = '';
$semester_id = '';
$error_message = '';
$success_message = '';

// Fetch semesters with their associated grades and academic stages
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

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if the `id` parameter is provided
    if (!isset($_GET['id'])) {
        header("Location: subject.php?error_message=" . urlencode("Subject ID is required"));
        exit;
    }

    $id = $_GET['id'];

    // Fetch the subject data for the given ID
    $sql = "SELECT * FROM subject WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: subject.php?error_message=" . urlencode("Subject not found"));
        exit;
    }

    // Populate the form with the existing data
    $subject = $row['subject'];
    $semester_id = $row['semester_id'];
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission for updating the subject
    $id = $_POST['id']; // Retrieve the ID from the hidden input field
    $subject = $_POST['subject'] ?? '';
    $semester_id = $_POST['semester_id'] ?? '';

    // Validate input
    if (empty($subject)) {
        $error_message = "Subject name is required";
    } elseif (empty($semester_id)) {
        $error_message = "Semester is required";
    } else {
        // Update the database
        $sql = "UPDATE subject SET semester_id = ?, subject = ? WHERE id = ?";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("isi", $semester_id, $subject, $id);
            if ($stmt->execute()) {
                $success_message = "Subject updated successfully";
                header("Location: subject.php?success_message=" . urlencode($success_message));
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

        <form method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id'] ?? ''); ?>">
            <h1>Edit Subject</h1>
            <div class="form-group">
                <label for="subject">Subject Name</label>
                <input type="text" class="form-control" id="subject" name="subject" value="<?php echo htmlspecialchars($subject); ?>">
            </div>
            <div class="form-group">
                <label for="semester_id">Semester (Grade - Academic Stage)</label>
                <select class="form-select mb-3" id="semester_id" name="semester_id" aria-label="Default select example">
                    <option selected disabled>Select a semester</option>
                    <?php while ($row = $resultSemesters->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($row["semester_id"]); ?>" <?php echo $row["semester_id"] == $semester_id ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars("Semester " . $row["semester_number"] . " - " . $row["grade"] . " (" . $row["academic_stage"] . ")"); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="subject.php" role='button'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'partials/footer.php' ?>