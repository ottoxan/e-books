<?php

session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require "config/database.php";
    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    $sqlStages = "SELECT * FROM academic_stage";
    $resultStages = $mysqli->query($sqlStages);
}

$success_message = isset($_GET['success_message']) ? urldecode($_GET['success_message']) : '';
?>




<?php if (isset($user)): ?>

    <?php include 'partials/header.php' ?>


    <!-- MAIN -->
    <main class="academic-stage">
        <div class="head-title">
            <div class="left">
                <h1>Academic Stages</h1>
            </div>
            <a href="create.php?type=academic_stage" id="btnOpenForm" class="btn-download">
                <i class='bx bxs-plus-circle'></i>
                <span class="text">Add</span>
            </a>
        </div>

        <?php if (!empty($success_message)) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success_message; ?>
            </div>
        <?php } ?>


        <div class="table-data">
            <div class="order">
                <table>
                    <thead>
                        <tr>
                            <th>Academic Stages</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <?php while ($row = $resultStages->fetch_assoc()): ?>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($row["academic_stage"]); ?>
                                </td>
                                <td>
                                    <a href='edit-academic.php?id=<?php echo htmlspecialchars($row["id"]); ?>' class='btn-primary m-1 p-1 rounded-2'>
                                        <span class='text'>Edit</span>
                                    </a>
                                    <a href='delete.php?type=academic_stage&id=<?php echo $row['id']; ?>' class='btn-danger p-1 rounded-2'>
                                        <span class='text'>Delete</span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </main>
    <script src="js/form.js"></script>

    <!-- MAIN -->


    <?php include 'partials/footer.php' ?>

<?php else: ?>
    <p>You are not logged in. <a href="login.php">Login</a></p>
<?php endif; ?>