<?php

session_start();
$mysqli = require "admin/config/database.php";

// Get the 'id' parameter from the URL
$id = $_GET['id'] ?? null;

if ($id) {
    // Sanitize the input
    $id = intval($id);

    // Fetch data based on the 'id'
    $sqlSubject = "SELECT * FROM subject WHERE semester_id = $id";
    $resultSubject = $mysqli->query($sqlSubject);

    if (!$resultSubject) {
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
        <h2 class="section-title">Subject</h2>
        <div class="projects-grid">
            <?php while ($row = $resultSubject->fetch_assoc()): ?>
                <div class="project-card" onclick="location.href='ebook.php?id=<?php echo $row['id']; ?>'">
                    <img src='assets/<?php echo htmlspecialchars($row["subject"]); ?>.jpg' class="card-image" alt="Picture">
                    <h3><?php echo htmlspecialchars($row["subject"]); ?></h3>
                    <div class="btn-grup">
                        <a href="ebook.php?id=<?php echo $row['id']; ?>" class="btn">View Details</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

    </section>
</main>
<!-- End Section -->

<?php include "partials/footer.php" ?>