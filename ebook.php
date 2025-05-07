<?php

session_start();
$mysqli = require "admin/config/database.php";

// Get the 'id' parameter from the URL
$id = $_GET['id'] ?? null;

if ($id) {
    // Sanitize the input
    $id = intval($id);

    // Fetch data based on the 'id'
    $sqlEbook = "SELECT * FROM ebooks WHERE subject_id = $id";
    $resultEbook = $mysqli->query($sqlEbook);

    if (!$resultEbook) {
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
                    <?php while ($row = $resultEbook->fetch_assoc()): ?>
                        <div class="project-card" onclick="showPdfModal('<?php echo 'uploads/ebooks/' . htmlspecialchars($row['book_file_name']); ?>')">
                            <img src="uploads/ebooks/<?php echo htmlspecialchars($row["file_cover"] ?? 'default-cover.jpg'); ?>" class="card-image" alt="Picture">
                            <h3><?php echo htmlspecialchars($row["book_title"]); ?></h3>
                            <div class="btn-grup">
                                <a href="#" class="btn">View PDF</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </section>
        </main>
        <!-- End Section -->

        <!-- PDF Modal -->
        <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pdfModalLabel">Ebook Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <iframe id="pdfViewer" src="" width="100%" height="600px" style="border: none;"></iframe>
                    </div>
                </div>
            </div>
        </div>

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
    <script>
        function showPdfModal(pdfUrl) {
            const pdfViewer = document.getElementById('pdfViewer');
            pdfViewer.src = pdfUrl; // Set the PDF file URL
            const pdfModal = new bootstrap.Modal(document.getElementById('pdfModal'));
            pdfModal.show(); // Show the modal
        }
    </script>
</body>

</html>