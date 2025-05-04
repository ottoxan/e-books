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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
    <div class="wrapper"> <!-- Mulai pembungkus -->

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand me-auto" href="#">Logo</a>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>

                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                            <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="#experience">Experience</a></li>
                            <li class="nav-item"><a class="nav-link" href="#skills">Skills</a></li>
                            <li class="nav-item"><a class="nav-link" href="#projects">Project</a></li>
                            <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <a href="admin/login.php" class="login-button">Login</a>
                <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <!-- End Navbar -->

        <!-- Section -->
        <main class="content">
            <section class="hero-section">
                <h2 class="section-title"></h2>
                <div class="projects-grid">
                    <?php while ($row = $resultSubject->fetch_assoc()): ?>
                        <div class="project-card" onclick="location.href='ebook.php?id=<?php echo $row['id']; ?>'">
                            <img src="assets/<?php echo htmlspecialchars($row[""] ?? null); ?>.png" class="card-image" alt="Picture">
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

        <!-- Footer -->
        <footer>
            <ul>
                <li><a href="#about">About</a></li>
                <li><a href="#experience">Experience</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <p class="copyright">&copy; All Rights Reserved | HYAHYA</p>
        </footer>

    </div> <!-- Tutup wrapper -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>