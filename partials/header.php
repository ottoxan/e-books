<?php require "lang.php"; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ebooks</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/stylebanner.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

</head>

<body>
    <div class="wrapper"> <!-- Mulai pembungkus -->

        <!-- Navbar -->
        <nav class="navbar navbar-light navbar-expand-lg fixed-top">
            <div class="container-fluid">
                <div class="Clogo d-flex justify-content-center align-items-center me-3">
                    <svg class=" logoSvg h-6 w-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                    </svg>
                </div>
                <a class="navbar-brand me-auto" href="index.php">Ebooks</a>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>

                    <div class="offcanvas-body">

                        <ul class="navbar-nav justify-content-center flex-grow-1 center-nav">
                            <li class="nav-item"><a class="nav-link active" href="index.php"><?= __('Home') ?></a></li>
                            <li class="nav-item"><a class="nav-link" href="#about"><?= __('About') ?></a></li>
                            <li class="nav-item"><a class="nav-link" href="#contact"><?= __('Contact') ?></a></li>
                        </ul>

                        <div class="search d-md-block me-3">
                            <div class="position-relative">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-info" viewBox="0 0 16 16">
                                    <path d="M6.5 4.482c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.69 0-5.018" />
                                    <path d="M13 6.5a6.47 6.47 0 0 1-1.258 3.844q.06.044.115.098l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1-.1-.115h.002A6.5 6.5 0 1 1 13 6.5M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11" />
                                </svg>
                                <input class="input-box form-control ps-5 pe-4 py-2 rounded-pill border border-info" type="text" id="searchInput" value="<?php echo isset($search) ? htmlspecialchars($search) : ''; ?>" placeholder="<?= __('Search a Book') ?>"
                                    onkeydown="if(event.key === 'Enter'){ event.preventDefault(); redirectToSearch(); }" />

                            </div>
                        </div>

                        <!-- Language Dropdown -->
                        <!-- Language Dropdown with Bootstrap Icons -->
                        <form class="lang d-flex me-3" role="search">
                            <select class="form-select rounded-pill" id="languageSelect" onchange="changeLanguage(this.value)">
                                <option value="en">English</option>
                                <option value="id">Indonesia</option>
                                <option value="th">ไทย</option>
                            </select>
                        </form>



                    </div>
                </div>
                <a href="login.php" class="login-button">Login</a>
                <button class="navbar-toggler p-0 ms-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <!-- End Navbar -->