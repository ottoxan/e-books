    <?php

    $mysqli = require "config/database.php";

    $academic_stage = '';
    $error_message = '';
    $success_message = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate the input data
        $academic_stage = $_POST["academic_stage"];

        do {
            if (empty($academic_stage)) {
                $error_message = "Academic stage is required";
                break;
            }

            $sql = "INSERT INTO academic_stage (academic_stage)" .
                "VALUES ('$academic_stage')";
            $result = $mysqli->query($sql);

            if (!$result) {
                $error_message = "Error: " . $mysqli->error;
                break;
            }

            $academic_stage = '';

            $success_message = "Academic stage created successfully";

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
                <h1>Create new</h1>
                <div class="form-group">
                    <label for="academic_stage">Academic Stage</label>
                    <input type="text" class="form-control" id="academic_stage" name="academic_stage" value="">
                </div>
                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a class="btn btn-outline-primary" href="academic_stage.php" role='button'>Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php include 'partials/footer.php' ?>