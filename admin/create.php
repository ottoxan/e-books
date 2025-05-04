<?php

$mysqli = require "config/database.php";

$type = $_GET['type'] ?? '';
$error_message = '';
$success_message = '';
$entity_name = '';
$fields = [];
$dropdowns = [];

switch ($type) {
    case 'academic_stage':
        $entity_name = 'Academic Stage';
        $fields = ['academic_stage'];
        break;
    case 'grade':
        $entity_name = 'Grade';
        $fields = ['grade', 'academic_id'];
        $dropdowns['academic_id'] = [
            'query' => "SELECT id, academic_stage FROM academic_stage",
            'label' => 'Academic Stage',
        ];
        break;
    case 'semester':
        $entity_name = 'Semester';
        $fields = ['semester_number', 'grade_id'];
        $dropdowns['grade_id'] = [
            'query' => "SELECT grade.id, grade.grade, academic_stage.academic_stage 
                        FROM grade 
                        JOIN academic_stage ON grade.academic_id = academic_stage.id",
            'label' => 'Grade (Academic Stage)',
        ];
        break;
    case 'subject':
        $entity_name = 'Subject';
        $fields = ['subject', 'semester_id'];
        $dropdowns['semester_id'] = [
            'query' => "SELECT semester.id, semester.semester_number, grade.grade, academic_stage.academic_stage 
                        FROM semester
                        JOIN grade ON semester.grade_id = grade.id
                        JOIN academic_stage ON grade.academic_id = academic_stage.id",
            'label' => 'Semester (Grade - Academic Stage)',
        ];
        break;
    case 'ebooks':
        $entity_name = 'Ebooks';
        $fields = ['book_title', 'subject_id', 'book_file_name'];
        $dropdowns['subject_id'] = [
            'query' => "SELECT subject.id, subject.subject, semester.semester_number, grade.grade, academic_stage.academic_stage 
                    FROM subject
                    JOIN semester ON subject.semester_id = semester.id
                    JOIN grade ON semester.grade_id = grade.id
                    JOIN academic_stage ON grade.academic_id = academic_stage.id",
            'label' => 'Subject (Semester - Grade - Academic Stage)',
        ];
        break;
    default:
        die("Invalid type");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [];
    foreach ($fields as $field) {
        if ($field === 'book_file_name') {
            // Handle file upload
            if (isset($_FILES['book_file_name']) && $_FILES['book_file_name']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = 'uploads/ebooks/';
                $file_name = basename($_FILES['book_file_name']['name']);
                $target_file = $upload_dir . $file_name;

                // Ensure the upload directory exists
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                // Move the uploaded file to the target directory
                if (move_uploaded_file($_FILES['book_file_name']['tmp_name'], $target_file)) {
                    $data[$field] = $file_name;
                } else {
                    $error_message = "Failed to upload the file.";
                    break;
                }
            } else {
                $error_message = "File is required.";
                break;
            }
        } else {
            // Handle regular fields
            $data[$field] = $_POST[$field] ?? '';
            if (empty($data[$field])) {
                $error_message = ucfirst(str_replace("_", " ", $field)) . " is required";
                break;
            }
        }
    }

    if (empty($error_message)) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $sql = "INSERT INTO $type ($columns) VALUES ($placeholders)";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param(str_repeat("s", count($data)), ...array_values($data));
            if ($stmt->execute()) {
                $success_message = "$entity_name created successfully";
                header("Location: {$type}.php?success_message=" . urlencode($success_message));
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

<?php include 'partials/header.php'; ?>

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

        <form method="POST" enctype="multipart/form-data">
            <h1>Create <?php echo htmlspecialchars($entity_name); ?></h1>
            <?php foreach ($fields as $field): ?>
                <?php if (isset($dropdowns[$field])): ?>
                    <div class="form-group">
                        <label for="<?php echo $field; ?>"><?php echo $dropdowns[$field]['label']; ?></label>
                        <select class="form-select" id="<?php echo $field; ?>" name="<?php echo $field; ?>">
                            <option selected disabled>Select <?php echo strtolower($dropdowns[$field]['label']); ?></option>
                            <?php
                            $result = $mysqli->query($dropdowns[$field]['query']);
                            while ($row = $result->fetch_assoc()): ?>
                                <option value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <?php
                                    // Display multiple fields for better context, with fallback values
                                    echo htmlspecialchars(
                                        ($row['subject'] ?? '') . ' ' . 
                                        ($row['semester_number'] ?? '') . ' ' .
                                        ($row['grade'] ?? '') . ' ' .
                                        ($row['academic_stage'] ?? '')
                                    );
                                    ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                <?php elseif ($field === 'book_file_name'): ?>
                    <div class="form-group">
                        <label for="<?php echo $field; ?>">Book File (PDF)</label>
                        <input type="file" class="form-control" id="<?php echo $field; ?>" name="<?php echo $field; ?>" accept=".pdf">
                    </div>
                <?php else: ?>
                    <div class="form-group">
                        <label for="<?php echo $field; ?>"><?php echo ucfirst(str_replace("_", " ", $field)); ?></label>
                        <input type="text" class="form-control" id="<?php echo $field; ?>" name="<?php echo $field; ?>" value="">
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="<?php echo $type; ?>.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'partials/footer.php'; ?>