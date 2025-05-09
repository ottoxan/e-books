<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    die("Unauthorized access.");
}

$mysqli = require "config/database.php";

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action === 'getGrades') {
        $stage_id = $_GET['stage'] ?? null;

        $sqlGrades = "
            SELECT grade.id, grade.grade, academic_stage.academic_stage 
            FROM grade
            LEFT JOIN academic_stage ON grade.academic_id = academic_stage.id
            WHERE 1=1
        ";

        if ($stage_id) {
            $sqlGrades .= " AND academic_stage.id = " . intval($stage_id);
        }

        $resultGrades = $mysqli->query($sqlGrades);

        $grades = [];
        while ($row = $resultGrades->fetch_assoc()) {
            $grades[] = $row;
        }
        echo json_encode($grades);
        exit;
    }
}

require 'partials/helpers.php'; // Include the helpers.php file


if (isset($_SESSION["user_id"])) {
    $mysqli = require "config/database.php";

    // Fetch user data
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Fetch grades with academic stages
    $sqlStages = "
        SELECT grade.id, grade.grade, academic_stage.academic_stage 
        FROM grade
        LEFT JOIN academic_stage ON grade.academic_id = academic_stage.id
    ";
    $resultStages = $mysqli->query($sqlStages);

    if (!$resultStages) {
        die("Database query failed: " . $mysqli->error);
    }
}

$success_message = isset($_GET['success_message']) ? htmlspecialchars($_GET['success_message']) : null;

?>

<?php if (isset($user)): ?>


    <?php include 'partials/header.php' ?>


    <!-- MAIN -->
    <main>
        <?php
        if (!empty($success_message)) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success_message; ?>
            </div>
        <?php } ?>
        <div class="head-title">
            <div class="left">
                <h1>Grade</h1>
            </div>


            <a href="create.php?type=grade" class="btn-download">
                <i class='bx bxs-plus-circle'></i>
                <span class="text">Add</span>
            </a>
        </div>

        <!-- Filters -->
        <form method="GET" class="mb-3">
            <div class="row">
                <!-- Academic Stage Filter -->
                <div class="col-md-12">
                    <label for="stage" class="form-label">Filter by Academic Stage:</label>
                    <select name="stage" id="stage" class="form-select" onchange="updateTable()">
                        <option value="">All Academic Stages</option>
                        <?php
                        $sqlStages = "SELECT * FROM academic_stage";
                        $resultStages = $mysqli->query($sqlStages);
                        while ($row = $resultStages->fetch_assoc()): ?>
                            <option value="<?php echo $row['id']; ?>">
                                <?php echo htmlspecialchars($row['academic_stage']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
        </form>

        <div class="table-data">
            <div class="order">

                <table>
                    <thead>
                        <tr>
                            <th>Grade</th>
                            <th>Academic Stage</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody id="grade-table-body">
                        <!-- Table rows will be dynamically populated -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <!-- MAIN -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/grade.js"></script>


    <?php include 'partials/footer.php' ?>

<?php else: ?>
    <p>You are not logged in. <a href="login.php">Login</a></p>
<?php endif; ?>