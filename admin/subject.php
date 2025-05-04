<?php

session_start();

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

    // Handle AJAX requests for dependent dropdowns
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

        if ($action === 'getSemesters' && isset($_GET['grade_id'])) {
            $grade_id = intval($_GET['grade_id']);
            $sqlSemesters = "SELECT * FROM semester WHERE grade_id = $grade_id";
            $resultSemesters = $mysqli->query($sqlSemesters);

            $semesters = [];
            while ($row = $resultSemesters->fetch_assoc()) {
                $semesters[] = $row;
            }
            echo json_encode($semesters);
            exit;
        }

        if ($action === 'getSubjects') {
            $selectedStage = $_GET['stage'] ?? null;
            $selectedGrade = $_GET['grade'] ?? null;
            $selectedSemester = $_GET['semester'] ?? null;

            $sqlSubjects = "
                SELECT 
                    subject.id,
                    subject.subject, 
                    semester.semester_number, 
                    grade.grade, 
                    academic_stage.academic_stage 
                FROM subject
                LEFT JOIN semester ON subject.semester_id = semester.id
                LEFT JOIN grade ON semester.grade_id = grade.id
                LEFT JOIN academic_stage ON grade.academic_id = academic_stage.id
                WHERE 1=1
            ";

            if ($selectedStage) {
                $sqlSubjects .= " AND academic_stage.id = " . intval($selectedStage);
            }
            if ($selectedGrade) {
                $sqlSubjects .= " AND grade.id = " . intval($selectedGrade);
            }
            if ($selectedSemester) {
                $sqlSubjects .= " AND semester.id = " . intval($selectedSemester);
            }

            $resultSubjects = $mysqli->query($sqlSubjects);

            if (!$resultSubjects) {
                die("Database query failed: " . $mysqli->error);
            }

            $subjects = [];
            while ($row = $resultSubjects->fetch_assoc()) {
                $subjects[] = $row;
            }
            echo json_encode($subjects);
            exit;
        }
    }

    // Fetch academic stages for the dropdown
    $sqlStages = "SELECT * FROM academic_stage";
    $resultStages = $mysqli->query($sqlStages);

    if (!$resultStages) {
        die("Database query failed: " . $mysqli->error);
    }

    // Fetch grades for the dropdown
    $sqlGrades = "SELECT * FROM grade";
    $resultGrades = $mysqli->query($sqlGrades);

    if (!$resultGrades) {
        die("Database query failed: " . $mysqli->error);
    }

    // Fetch semesters for the dropdown
    $sqlSemesters = "SELECT * FROM semester";
    $resultSemesters = $mysqli->query($sqlSemesters);

    if (!$resultSemesters) {
        die("Database query failed: " . $mysqli->error);
    }

    // Fetch subjects with filters
    $selectedStage = $_GET['stage'] ?? null;
    $selectedGrade = $_GET['grade'] ?? null;
    $selectedSemester = $_GET['semester'] ?? null;

    $sqlSubjects = "
        SELECT 
            subject.id,
            subject.subject, 
            semester.semester_number, 
            grade.grade, 
            academic_stage.academic_stage 
        FROM subject
        LEFT JOIN semester ON subject.semester_id = semester.id
        LEFT JOIN grade ON semester.grade_id = grade.id
        LEFT JOIN academic_stage ON grade.academic_id = academic_stage.id
        WHERE 1=1
    ";

    if ($selectedStage) {
        $sqlSubjects .= " AND academic_stage.id = " . intval($selectedStage);
    }
    if ($selectedGrade) {
        $sqlSubjects .= " AND grade.id = " . intval($selectedGrade);
    }
    if ($selectedSemester) {
        $sqlSubjects .= " AND semester.id = " . intval($selectedSemester);
    }

    $resultSubjects = $mysqli->query($sqlSubjects);

    if (!$resultSubjects) {
        die("Database query failed: " . $mysqli->error);
    }
}

$success_message = isset($_GET['success_message']) ? htmlspecialchars($_GET['success_message']) : null;

?>

<!-- MAIN -->
<?php if (isset($user)): ?>
    <?php include 'partials/header.php' ?>

    <main>
        <?php
        if (!empty($success_message)) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success_message; ?>
            </div>
        <?php } ?>
        <div class="head-title">
            <div class="left">
                <h1>Subjects</h1>
            </div>
            <a href="create.php?type=subject" class="btn-download">
                <i class='bx bxs-plus-circle'></i>
                <span class="text">Add</span>
            </a>
        </div>

        <!-- Filters -->
        <form method="GET" class="mb-3">
            <div class="row">
                <!-- Academic Stage Filter -->
                <div class="col-md-4">
                    <label for="stage" class="form-label">Filter by Academic Stage:</label>
                    <select name="stage" id="stage" class="form-select" onchange="updateGrades(this.value)">
                        <option value="">All Academic Stages</option>
                        <?php while ($row = $resultStages->fetch_assoc()): ?>
                            <option value="<?php echo $row['id']; ?>" <?php echo ($selectedStage == $row['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($row['academic_stage']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Grade Filter -->
                <div class="col-md-4">
                    <label for="grade" class="form-label">Filter by Grade:</label>
                    <select name="grade" id="grade" class="form-select" onchange="updateSemesters(this.value)">
                        <option value="">All Grades</option>
                        <!-- Options will be dynamically populated -->
                    </select>
                </div>

                <!-- Semester Filter -->
                <div class="col-md-4">
                    <label for="semester" class="form-label">Filter by Semester:</label>
                    <select name="semester" id="semester" class="form-select">
                        <option value="">All Semesters</option>
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
                            <th>Subject</th>
                            <th>Semester</th>
                            <th>Grade</th>
                            <th>Academic Stage</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody id="subject-table-body">
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
    <script src="js/subject.js"></script>


    <?php include 'partials/footer.php' ?>

<?php else: ?>
    <p>You are not logged in. <a href="login.php">Login</a></p>
<?php endif; ?>