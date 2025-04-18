<?php

session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require "../../config/database.php";

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
            semester.semester_number, 
            grade.grade, 
            academic_stage.academic_stage 
        FROM semester
        JOIN grade ON semester.grade_id = grade.id
        JOIN academic_stage ON grade.academic_id = academic_stage.id
    ";
    $resultSemesters = $mysqli->query($sqlSemesters);

    if (!$resultSemesters) {
        die("Database query failed: " . $mysqli->error);
    }
}
?>

<!-- MAIN -->
<main>
    <div class="head-title">
        <div class="left">
            <h1>Semester</h1>
        </div>
        <a href="#" class="btn-download">
            <i class='bx bxs-plus-circle'></i>
            <span class="text">Add</span>
        </a>
    </div>


    <div class="table-data">
        <div class="order">

            <table>
                <thead>
                    <tr>
                        <th>Semester</th>
                        <th>Academic Stage</th>
                        <th>Grade</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $resultSemesters->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <?php echo htmlspecialchars($row["semester_number"]); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($row["academic_stage"]); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($row["grade"]); ?>
                            </td>
                            <td>
                                <a href="#" class="btn-primary m-1 p-1 rounded-2">
                                    <span class="text">Edit</span>
                                </a>
                                <a href="#" class="btn-danger p-1 rounded-2">
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
</section>
<!-- CONTENT -->