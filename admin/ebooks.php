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

    // Fetch ebooks with academic, grade, semester, and subject details
    $sqlEbooks = "
        SELECT 
            ebooks.id,
            ebooks.book_title,
            ebooks.book_file_name,
            ebooks.file_cover,
            academic_stage.academic_stage,
            grade.grade,
            semester.semester_number,
            subject.subject
        FROM ebooks
        LEFT JOIN academic_stage ON ebooks.academic_id = academic_stage.id
        LEFT JOIN grade ON ebooks.grade_id = grade.id
        LEFT JOIN semester ON ebooks.semester_id = semester.id
        LEFT JOIN subject ON ebooks.subject_id = subject.id
    ";
    $resultEbooks = $mysqli->query($sqlEbooks);

    if (!$resultEbooks) {
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
                <h1>Ebooks</h1>
            </div>
            <a href="create-ebook.php" class="btn-download">
                <i class='bx bxs-plus-circle'></i>
                <span class="text">Add</span>
            </a>
        </div>

        <div class="table-data">
            <div class="order">
                <table>
                    <thead>
                        <tr>
                            <th>Book Title</th>
                            <th>File Name</th>
                            <th>Book Cover</th>
                            <th>Academic Stage</th>
                            <th>Grade</th>
                            <th>Semester</th>
                            <th>Subject</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $resultEbooks->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($row["book_title"] ?? 'N/A'); ?>
                                </td>
                                <td>
                                    <?php
                                    $file_path = "uploads/ebooks/" . htmlspecialchars($row["book_file_name"] ?? '');
                                    if (!empty($row["book_file_name"]) && file_exists($file_path)): ?>
                                        <a href="<?php echo $file_path; ?>" target="_blank">
                                            <?php echo htmlspecialchars($row["book_file_name"]); ?>
                                        </a>
                                    <?php else: ?>
                                        <span>File not found</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                    $file_path = "uploads/ebooks/" . htmlspecialchars($row["file_cover"] ?? '');
                                    if (!empty($row["file_cover"]) && file_exists($file_path)): ?>
                                        <img src="<?php echo $file_path; ?>" alt="Book Cover" class="w-[50px] h-[50px]" >
                                    <?php else: ?>
                                        <span>File not found</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($row["academic_stage"] ?? 'N/A'); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($row["grade"] ?? 'N/A'); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($row["semester_number"] ?? 'N/A'); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($row["subject"] ?? 'N/A'); ?>
                                </td>
                                <td>
                                    <?php echo renderActionButtons('ebooks', $row['id'], 'ebooks'); ?>
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