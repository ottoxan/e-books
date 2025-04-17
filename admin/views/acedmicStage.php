<?php

session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require "../../config/database.php";
    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    $sqlStages = "SELECT * FROM academic_stage"; // Replace with your actual table name
    $resultStages = $mysqli->query($sqlStages);
}
?>
    
<!-- MAIN -->
<main>
    <div class="head-title">
        <div class="left">
            <h1>Academic Stages</h1>
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
                                <a href='#' class='btn-primary m-1 p-1 rounded-2'>
                                    <span class='text'>Edit</span>
                                </a>
                                <a href='#' class='btn-danger p-1 rounded-2'>
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
<!-- MAIN -->