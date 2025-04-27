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
                                    <button onclick="location.href='edit-academic.php?id=<?php echo htmlspecialchars($row['id']); ?>'" class='btn-primary m-1 p-1 rounded-2'>
                                        <span class='text'>Edit</span>
                                    </button>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn-danger p-1 rounded-2" data-toggle="modal" data-target="#exampleModalCenter">
                                        Delete
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Are you sure?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" onclick="location.href='delete.php?type=academic_stage&id=<?php echo $row['id']; ?>'" class="btn btn-danger">Yes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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