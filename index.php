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
    <!--Navbar-->
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
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="About">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Experience">Experience</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Skills</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Project</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
            <a href="admin/login.php" class="login-button">Login</a>
            <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <!--End-->

    <!--Section-->
    <section class="hero-section">
        <h2 class="section-title">Recent Projects</h2>

        <div class="projects-grid">

            <div class="project-card">
                <img src="#" alt="">
                <h3>Project A</h3>
                <p>Lorem, ipsum dolor sit amet consectetur
                    adipisicing elit. Placeat, officia.</p>
                <div class="btn-grup">
                    <div class="btn">Live Demo</div>
                    <div class="btn">Github Repo</div>
                </div>
            </div>

            <div class="project-card">
                <img src="#" alt="">
                <h3>Project B</h3>
                <p>Lorem, ipsum dolor sit amet consectetur
                    adipisicing elit. Placeat, officia.</p>
                <div class="btn-grup">
                    <div class="btn">Live Demo</div>
                    <div class="btn">Github Repo</div>
                </div>
            </div>

            <div class="project-card">
                <img src="#" alt="">
                <h3>Project C</h3>
                <p>Lorem, ipsum dolor sit amet consectetur
                    adipisicing elit. Placeat, officia.</p>
                <div class="btn-grup">
                    <div class="btn">Live Demo</div>
                    <div class="btn">Github Repo</div>
                </div>
            </div>
        </div>
    </section>
    <!--End-->

    <footer>
        <ul>
            <li>
                <a href="#about">About</a>
            </li>

            <li>
                <a href="#experience">Experience</a>
            </li>

            <li>
                <a href="#skills">Skills</a>
            </li>

            <li>
                <a href="#projects">Projects</a>
            </li>

            <li>
                <a href="#contact">Contact</a>
            </li>
        </ul>

        <p class="copyright">@ All Right Reserved | HYAHYA</p>
    </footer>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>