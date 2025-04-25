<?php

session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require "config/database.php";

    // Fetch user data
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Fetch subjects with semesters, grades, and academic stages
    $sqlSubjects = "
        SELECT 
            subject.id,
            subject.subject, 
            semester.semester_number, 
            grade.grade, 
            academic_stage.academic_stage 
        FROM subject
        JOIN semester ON subject.semester_id = semester.id
        JOIN grade ON semester.grade_id = grade.id
        JOIN academic_stage ON grade.academic_id = academic_stage.id
    ";
    $resultSubjects = $mysqli->query($sqlSubjects);

    if (!$resultSubjects) {
        die("Database query failed: " . $mysqli->error);
    }
}
?>

<!-- MAIN -->
<?php if (isset($user)): ?>
    <?php include 'partials/header.php' ?>

    <main>
        <div class="head-title">
            <div class="left">
                <h1>Subjects</h1>
            </div>
            <a href="create.php?type=subject" class="btn-download">
                <i class='bx bxs-plus-circle'></i>
                <span class="text">Add</span>
            </a>
        </div>


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
                    <tbody>
                        <?php while ($row = $resultSubjects->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($row["subject"]); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($row["semester_number"]); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($row["grade"]); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($row["academic_stage"]); ?>
                                </td>
                                <td>
                                    <a href="edit-subject.php?id=<?php echo htmlspecialchars($row["id"]); ?>" class="btn-primary m-1 p-1 rounded-2">
                                        <span class="text">Edit</span>
                                    </a>
                                    <a href="delete.php?type=subject&id=<?php echo $row['id']; ?>" class="btn-danger p-1 rounded-2">
                                        <span class="text">Delete</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <!-- MAIN -->

    <?php include 'partials/footer.php' ?>

<?php else: ?>
    <p>You are not logged in. <a href="login.php">Login</a></p>
<?php endif; ?>