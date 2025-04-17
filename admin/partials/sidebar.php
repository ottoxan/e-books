<?php

$page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
?>

<!-- SIDEBAR -->
<section id="sidebar">
    <a href="#" class="brand">
        <i class='bx bxs-smile'></i>
        <span class="text">AdminHub</span>
    </a>
    <ul class="side-menu top p-0">
        <li class="<?php echo $page == 'views/home.php' ? 'active' : ''; ?>">
            <a onclick="loadContent('views/home.php')">
                <i class='bx bxs-dashboard'></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li class="<?php echo $page == 'views/acedmicStage.php' ? 'active' : ''; ?>">
            <a onclick="loadContent('views/acedmicStage.php')">
                <i class='bx bxs-shopping-bag-alt'></i>
                <span class="text">Acedmic Stage</span>
            </a>
        </li>
        <li class="<?php echo $page == 'views/grade.php' ? 'active' : ''; ?>">
            <a onclick="loadContent('views/grade.php')">
                <i class='bx bxs-doughnut-chart'></i>
                <span class="text">Grade</span>
            </a>
        </li>
        <li class="<?php echo $page == 'views/semester.php' ? 'active' : ''; ?>">
            <a onclick="loadContent('views/semester.php')">
                <i class='bx bxs-message-dots'></i>
                <span class="text">Semester</span>
            </a>
        </li>
        <li class="<?php echo $page == 'views/subject.php' ? 'active' : ''; ?>">
            <a onclick="loadContent('views/subject.php')">
                <i class='bx bxs-group'></i>
                <span class="text">Subject</span>
            </a>
        </li>
        <li class="<?php echo $page == 'views/ebook.php' ? 'active' : ''; ?>">
            <a onclick="loadContent('views/ebook.php')">
                <i class='bx bxs-group'></i>
                <span class="text">Ebooks</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu p-0">
        <li>
            <a href="#">
                <i class='bx bxs-cog'></i>
                <span class="text">Settings</span>
            </a>
        </li>
        <li>
            <a href="logout.php" class="logout">
                <i class='bx bxs-log-out-circle'></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>

<script src="js/ajax.js"></script>


<!-- SIDEBAR -->