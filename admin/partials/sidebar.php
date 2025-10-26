<?php

$page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);

?>


<!-- SIDEBAR -->
<section id="sidebar" class="hide">
    <a href="#" class="brand">
        <i class='bx bxs-smile'></i>
        <span class="text">AdminHub</span>
    </a>
    <ul class="side-menu top p-0">
        <li class="<?php echo $page == 'dashboard.php' ? 'active' : ''; ?>">
            <a href="dashboard.php">
                <i class='bx bxs-dashboard'></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li class="<?php echo $page == 'academic_stage.php' ? 'active' : ''; ?>">
            <a href="academic_stage.php">
                <i class='bx bxs-school'></i>
                <span class="text">Acedmic Stage</span>
            </a>
        </li>
        <li class="<?php echo $page == 'grade.php' ? 'active' : ''; ?>">
            <a href="grade.php">
                <i class='bx bx-file-detail'></i>
                <span class="text">Grade</span>
            </a>
        </li>
        <li class="<?php echo $page == 'semester.php' ? 'active' : ''; ?>">
            <a href="semester.php">
                <i class='bx bx-file-detail'></i>
                <span class="text">Semester</span>
            </a>
        </li>
        <li class="<?php echo $page == 'subject.php' ? 'active' : ''; ?>">
            <a href="subject.php">
                <i class='bx bx-file-detail'></i>
                <span class="text">Subject</span>
            </a>
        </li>
        <li class="<?php echo $page == 'ebooks.php' ? 'active' : ''; ?>">
            <a href="ebooks.php">
                <i class='bx bx-book-library'></i>
                <span class="text">Ebooks</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu p-0">
        <li class="">
            <a href="settings.php">
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

<script src="js/form.js"></script>


<!-- SIDEBAR -->