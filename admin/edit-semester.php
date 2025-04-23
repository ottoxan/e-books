<?php

$mysqli = require "config/database.php";

$semester_number = '';
$grade_id = '';
$error_message = '';
$success_message = '';

// Fetch grades with their associated academic stages
$sqlGrades = "SELECT grade.id, grade.grade, academic_stage.academic_stage 
              FROM grade 
              JOIN academic_stage ON grade.academic_id = academic_stage.id";
$resultGrades = $mysqli->query($sqlGrades);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if the `id` parameter is provided
    if (!isset($_GET['id'])) {
        header("Location: semester.php?error_message=" . urlencode("Semester ID is required"));
        exit;
    }

    $id = $_GET['id'];

    // Fetch the semester data for the given ID
    $sql = "SELECT * FROM semester WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: semester.php?error_message=" . urlencode("Semester not found"));
        exit;
    }

    // Populate the form with the existing data
    $semester_number = $row['semester_number'];
    $grade_id = $row['grade_id'];
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission for updating the semester
    $id = $_POST['id']; // Retrieve the ID from the hidden input field
    $semester_number = $_POST['semester_number'] ?? '';
    $grade_id = $_POST['grade_id'] ?? '';

    // Validate input
    if (empty($semester_number)) {
        $error_message = "Semester number is required";
    } elseif (empty($grade_id)) {
        $error_message = "Grade is required";
    } else {
        // Update the database
        $sql = "UPDATE semester SET grade_id = ?, semester_number = ? WHERE id = ?";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("isi", $grade_id, $semester_number, $id);
            if ($stmt->execute()) {
                $success_message = "Semester updated successfully";
                header("Location: semester.php?success_message=" . urlencode($success_message));
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
            <h1>Edit Semester</h1>
            <div class="form-group">
                <label for="semester_number">Semester Number</label>
                <input type="text" class="form-control" id="semester_number" name="semester_number" value="<?php echo htmlspecialchars($semester_number); ?>">
            </div>
            <div class="form-group">
                <label for="grade_id">Grade (Academic Stage)</label>
                <select class="form-select mb-3" id="grade_id" name="grade_id" aria-label="Default select example">
                    <option selected disabled>Select a grade</option>
                    <?php while ($row = $resultGrades->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($row["id"]); ?>" <?php echo $row["id"] == $grade_id ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($row["grade"] . " (" . $row["academic_stage"] . ")"); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="semester.php" role='button'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'partials/footer.php' ?>