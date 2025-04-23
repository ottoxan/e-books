<?php

$mysqli = require "config/database.php";

$id = '';
$academic_stage = '';
$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET['id'])) {
        header("Location: academic_stage.php?error_message=" . urlencode("ID is required"));
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM academic_stage WHERE id = $id";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: academic_stage.php?error_message=" . urlencode("Error: " . $mysqli->error));
        exit;
    }


    $id = $row['id'];
    $academic_stage = $row['academic_stage'];
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id']; // Retrieve the ID from the hidden input field
    $academic_stage = $_POST['academic_stage'];

    do {
        if (empty($academic_stage)) {
            $error_message = "Academic stage is required";
            break;
        }

        // Use prepared statements to prevent SQL injection
        $stmt = $mysqli->prepare("UPDATE academic_stage SET academic_stage = ? WHERE id = ?");
        $stmt->bind_param("si", $academic_stage, $id);

        if (!$stmt->execute()) {
            $error_message = "Error: " . $stmt->error;
            break;
        }

        $success_message = "Academic stage updated successfully";

        header("Location: academic_stage.php?success_message=" . urlencode($success_message));
        exit;
    } while (false);
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
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id) ?>">
            <h1>Update</h1>
            <div class="form-group">
                <label for="academic_stage">Academic Stage</label>
                <input type="text" class="form-control" id="academic_stage" name="academic_stage" value="<?php echo $academic_stage ?>">
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="academic_stage.php" role='button'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'partials/footer.php' ?>