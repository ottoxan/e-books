<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    die("Unauthorized access.");
}

$mysqli = require "config/database.php";

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action === 'getGrades' && isset($_GET['stage_id'])) {
        $stage_id = intval($_GET['stage_id']);
        $sqlGrades = "SELECT * FROM grade WHERE academic_id = $stage_id";
        $resultGrades = $mysqli->query($sqlGrades);

        $grades = [];
        while ($row = $resultGrades->fetch_assoc()) {
            $grades[] = $row;
        }
        echo json_encode($grades);
        exit;
    }

    if ($action === 'getSemesters') {
        $stage_id = $_GET['stage'] ?? null;
        $grade_id = $_GET['grade'] ?? null;

        $sqlSemesters = "
            SELECT 
                semester.id,
                semester.semester_number, 
                grade.grade, 
                academic_stage.academic_stage 
            FROM semester
            LEFT JOIN grade ON semester.grade_id = grade.id
            LEFT JOIN academic_stage ON grade.academic_id = academic_stage.id
            WHERE 1=1
        ";

        if ($stage_id) {
            $sqlSemesters .= " AND academic_stage.id = " . intval($stage_id);
        }
        if ($grade_id) {
            $sqlSemesters .= " AND grade.id = " . intval($grade_id);
        }

        $resultSemesters = $mysqli->query($sqlSemesters);

        $semesters = [];
        while ($row = $resultSemesters->fetch_assoc()) {
            $semesters[] = $row;
        }
        echo json_encode($semesters);
        exit;
    }
}

if (isset($_SESSION["user_id"])) {
    $mysqli = require "config/database.php";

    // Fetch user data
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Fetch semesters with grades and academic stages
    $sqlSemesters = "
        SELECT 
            semester.id,
            semester.semester_number, 
            grade.grade, 
            academic_stage.academic_stage 
        FROM semester
        LEFT JOIN grade ON semester.grade_id = grade.id
        LEFT JOIN academic_stage ON grade.academic_id = academic_stage.id
    ";
    $resultSemesters = $mysqli->query($sqlSemesters);

    if (!$resultSemesters) {
        die("Database query failed: " . $mysqli->error);
    }
}

$success_message = isset($_GET['success_message']) ? htmlspecialchars($_GET['success_message']) : null;

?>

<?php if (isset($user)): ?>
    <?php include 'partials/header.php' ?>

    <main>
        <?php if (!empty($success_message)) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success_message; ?>
            </div>
        <?php } ?>
        <div class="head-title">
            <div class="left">
                <h1>Semester</h1>
            </div>
            <a href="create.php?type=semester" class="btn-download">
                <i class='bx bxs-plus-circle'></i>
                <span class="text">Add</span>
            </a>
        </div>

        <!-- Filters -->
        <form method="GET" class="mb-3">
            <div class="row">
                <!-- Academic Stage Filter -->
                <div class="col-md-6">
                    <label for="stage" class="form-label">Filter by Academic Stage:</label>
                    <select name="stage" id="stage" class="form-select" onchange="updateGrades(this.value)">
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

                <!-- Grade Filter -->
                <div class="col-md-6">
                    <label for="grade" class="form-label">Filter by Grade:</label>
                    <select name="grade" id="grade" class="form-select" onchange="updateTable()">
                        <option value="">All Grades</option>
                        <!-- Options will be dynamically populated -->
                    </select>
                </div>
            </div>
        </form>

        <div class="table-data">
            <div class="order">
                <table>
                    <thead>
                        <tr>
                            <th>Semester</th>
                            <th>Grade</th>
                            <th>Academic Stage</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody id="semester-table-body">
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script src="js/semester.js"></script>
    <?php include 'partials/footer.php' ?>
<?php else: ?>
    <p>You are not logged in. <a href="login.php">Login</a></p>
<?php endif; ?>