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

    // Fetch subjects with semesters, grades, and academic stages
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
    ";
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
                                    <?php echo htmlspecialchars($row["subject"] ?? 'null'); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($row["semester_number"] ?? 'null'); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($row["grade"] ?? 'null'); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($row["academic_stage"] ?? 'null'); ?>
                                </td>
                                <td>
                                    <?php echo renderActionButtons('subject', $row['id'], 'subject' ?? 'null'); ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <!-- MAIN -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <?php include 'partials/footer.php' ?>

<?php else: ?>
    <p>You are not logged in. <a href="login.php">Login</a></p>
<?php endif; ?>