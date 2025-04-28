<?php

session_start();

require 'partials/helpers.php'; // Include the helpers.php file

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
                                    <?php echo renderActionButtons('academic', $row['id'], 'academic_stage'); ?>
                                </td>
                            </tr>
                        </tbody>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </main>
    <script src="js/form.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- MAIN -->


    <?php include 'partials/footer.php' ?>

<?php else: ?>
    <p>You are not logged in. <a href="login.php">Login</a></p>
<?php endif; ?>