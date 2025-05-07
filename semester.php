<?php

session_start();
$mysqli = require "admin/config/database.php";

// Get the 'id' parameter from the URL
$id = $_GET['id'] ?? null;

if ($id) {
    // Sanitize the input
    $id = intval($id);

    // Fetch data based on the 'id'
    $sqlSemester = "SELECT * FROM semester WHERE grade_id = $id";
    $resultSemeter = $mysqli->query($sqlSemester);

    if (!$resultSemeter) {
        die("Database query failed: " . $mysqli->error);
    }
} else {
    die("No ID provided in the URL.");
}
?>

<?php include "partials/header.php" ?>

<!-- Section -->
<main class="content">
    <section class="hero-section">
        <h2 class="section-title">Semester</h2>
        <div class="projects-grid">
            <?php while ($row = $resultSemeter->fetch_assoc()): ?>
                <div class="project-card" onclick="location.href='subject.php?id=<?php echo $row['id']; ?>'">
                    <?php $imageIndex = isset($imageIndex) ? $imageIndex + 1 : 1; // Set the desired image index dynamically 
                    ?>
                    <img src="assets/<?php echo $imageIndex; ?>.jpg" class="card-image" alt="Picture">
                    <h3><?php echo htmlspecialchars($row["semester_number"]); ?></h3>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
</main>
<!-- End Section -->

<?php include "partials/footer.php" ?>