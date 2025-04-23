<?php

$mysqli = require "config/database.php";

$grade = '';
$academic_id = '';
$error_message = '';
$success_message = '';

// Fetch academic stages
$sqlStages = "SELECT * FROM academic_stage";
$resultStages = $mysqli->query($sqlStages);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET['id'])) {
        header("Location: grade.php?error_message=" . urlencode("Grade ID is required"));
        exit;
    }

    $id = $_GET['id'];

    // Fetch the grade data for the given ID
    $sql = "SELECT * FROM grade WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: grade.php?error_message=" . urlencode("Grade not found"));
        exit;
    }

    // Populate the form with the existing data
    $grade = $row['grade'];
    $academic_id = $row['academic_id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $grade = $_POST["grade"] ?? '';
    $academic_id = $_POST["academic_id"] ?? '';

    // Validate input
    if (empty($grade)) {
        $error_message = "Grade is required";
    } elseif (empty($academic_id)) {
        $error_message = "Academic stage is required";
    } else {
        // Insert into database
        $sql = "INSERT INTO grade (academic_id, grade) VALUES (?, ?)";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("is", $academic_id, $grade);
            if ($stmt->execute()) {
                $success_message = "Grade created successfully";
                header("Location: grade.php?success_message=" . urlencode($success_message));
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

<?php
if (!empty($success_message)) { ?>
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
            <h1>Edit Grade</h1>
            <div class="form-group">
                <label for="grade">Grade</label>
                <input type="text" class="form-control" id="grade" name="grade" value="<?php echo htmlspecialchars($grade); ?>">
            </div>
            <div class="form-group">
                <label for="academic_id">Academic Stage</label>
                <select class="form-select mb-3" id="academic_id" name="academic_id" aria-label="Default select example">
                    <option selected disabled>Select an academic stage</option>
                    <?php while ($stage = $resultStages->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($stage["id"]); ?>" <?php echo $stage["id"] == $academic_id ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($stage["academic_stage"]); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="grade.php" role='button'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'partials/footer.php' ?>