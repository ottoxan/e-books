<?php

session_start();
$mysqli = require "admin/config/database.php";
$sqlStages = "SELECT * FROM academic_stage";
$resultStages = $mysqli->query($sqlStages);
?>


<?php include "partials/header.php" ?>

        <!-- Section -->
        <main class="content">
            <section class="hero-section">
                <h2 class="section-title">Academic Stage</h2>
                <div class="projects-grid">
                    <?php while ($row = $resultStages->fetch_assoc()): ?>
                        <div class="project-card" onclick="location.href='grade.php?id=<?php echo $row['id']; ?>'">
                            <img src="assets/<?php echo htmlspecialchars($row["academic_stage"]); ?>.png" class="card-image" alt="">
                            <h3><?php echo htmlspecialchars($row["academic_stage"]); ?></h3>
                            <div class="btn-grup">
                                <a href="grade.php?id=<?php echo $row['id']; ?>" class="btn">View Details</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </section>
        </main>
        <!-- End Section -->
<?php include "partials/footer.php" ?>