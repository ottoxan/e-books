<?php
require "config/allebooks-conf.php";
?>

<!-- MAIN -->
<main id="content-main">
    <div class="head-title">
        <div class="left">
            <h1>Dashboard</h1>
        </div>
    </div>

    <div class="dashboard-content">
        <ul class="box-info w-100">
            <li class="d-flex py-0 flex-column pt-5">
                <div class="container">
                    <div class="section-header">
                        <h2 class="">
                            <?= __('Other books') ?>
                        </h2>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center">
                        <?php if (!empty($ebooks)): ?>
                            <?php foreach ($ebooks as $ebook): ?>
                                <div class="card book-card" onclick="window.open('/ebook.php?id=<?php echo $ebook["id"]; ?>', '_blank').focus();">
                                    <img src="../uploads/ebooks/<?php echo htmlspecialchars($ebook["file_cover"] ?? 'default-cover.jpg'); ?>" alt="<?php echo htmlspecialchars($ebook["book_title"]); ?>" class="book-image">
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <span class="badge bg-danger">PDF</span>
                                            <span class="badge bg-primary"><?php echo htmlspecialchars($ebook['grade']); ?></span>
                                            <span class="badge bg-primary"><?php echo htmlspecialchars($ebook['semester_number']); ?></span>
                                        </div>
                                        <h5 class="card-title"><?php echo htmlspecialchars($ebook["book_title"]); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($ebook['academic_stage']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p><?= __('No ebooks available.') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Bootstrap Pagination -->
                    <?php if ($totalPages > 1): ?>
                        <div aria-label="Ebooks pagination" class="mt-4">
                            <ul class="pagination justify-content-center">
                                <li class="page-item<?php if ($page <= 1) echo ' disabled'; ?> p-0">
                                    <a class="page-link" href="?page=1">&laquo;</a>
                                </li>
                                <li class="page-item<?php if ($page <= 1) echo ' disabled'; ?> p-0">
                                    <a class="page-link" href="?page=<?php echo max(1, $page - 1); ?>">&lt;</a>
                                </li>
                                <?php
                                // Show up to 5 page links
                                $start = max(1, $page - 2);
                                $end = min($totalPages, $page + 2);
                                for ($i = $start; $i <= $end; $i++): ?>
                                    <li class="page-item<?php if ($i == $page) echo ' active'; ?> p-0">
                                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                                <li class="page-item<?php if ($page >= $totalPages) echo ' disabled'; ?> p-0">
                                    <a class="page-link" href="?page=<?php echo min($totalPages, $page + 1); ?>">&gt;</a>
                                </li>
                                <li class="page-item<?php if ($page >= $totalPages) echo ' disabled'; ?> p-0">
                                    <a class="page-link" href="?page=<?php echo $totalPages; ?>">&raquo;</a>
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </li>
        </ul>
        <ul class="box-info">
            <li>
                <div style="width: 400px; display: flex; flex-direction: column; align-items: center;">
                    <span style="font-size: 50px; color: var(--dark);" class="text">Total Books</span><br>
                    <span style="font-size: 50px; color: var(--dark);" class="number" id="total-books">0</span>
                </div>
            </li>
            <li>
                <div style="width: 400px;"><canvas id="acquisitions"></canvas></div>
            </li>
        </ul>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="module" src="js/acquisitions.js"></script>
</main>
<!-- MAIN -->