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


            <a href="create-grade.php" class="btn-download">
                <i class='bx bxs-plus-circle'></i>
                <span class="text">Add</span>
            </a>
        </div>


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
                    <?php while ($row = $resultStages->fetch_assoc()): ?>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($row["grade"]); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($row["academic_stage"] ?? 'null'); ?>
                                </td>
                                <td>
                                    <a href="edit-grade.php?id=<?php echo htmlspecialchars($row["id"]); ?>" class="btn-primary m-1 p-1 rounded-2">
                                        <span class="text">Edit</span>
                                    </a>
                                    <a href="delete.php?type=grade&id=<?php echo $row['id']; ?>" class="btn-danger p-1 rounded-2">
                                        <span class="text">Delete</span>
                                    </a>

                                </td>
                            </tr>
                        </tbody>
                    <?php endwhile; ?>

                </table>
            </div>
        </div>
    </main>
    <!-- MAIN -->

    <?php include 'partials/footer.php' ?>

<?php else: ?>
    <p>You are not logged in. <a href="login.php">Login</a></p>
<?php endif; ?>