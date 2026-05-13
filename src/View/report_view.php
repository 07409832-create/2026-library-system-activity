<?php declare(strict_types=1); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Library Report</title>
</head>
<body>
    <div class="report-container">
        <h1>Library Report</h1>
        
        <nav>
            <p><a href="/2026-library-system-activity/public/index.php">← Back to Home</a></p>
            <p><a href="/2026-library-system-activity/public/index.php?act=list">List All Books</a></p>
            <p><a href="/2026-library-system-activity/public/index.php?act=add">Add New Book</a></p>
            <p><a href="/2026-library-system-activity/public/index.php?act=search">Search Books</a></p>
            <p><a href="/2026-library-system-activity/public/index.php?act=borrow">Borrow Book</a></p>
            <p><a href="/2026-library-system-activity/public/index.php?act=overdue">View Overdue Books</a></p>
        </nav>
        
        <div class="report-item">
            <span class="report-label">Total Books:</span>
            <span class="report-value"><?= htmlspecialchars((string) $reportData['totalBooks']) ?></span>
        </div>
        
        <div class="report-item">
            <span class="report-label">Currently Borrowed:</span>
            <span class="report-value"><?= htmlspecialchars((string) $reportData['totalBorrowed']) ?></span>
        </div>
        
        <div class="report-item">
            <span class="report-label">Total Returned:</span>
            <span class="report-value"><?= htmlspecialchars((string) $reportData['totalReturned']) ?></span>
        </div>
        
        <div class="report-item">
            <span class="report-label">Total Fines Collected:</span>
            <span class="report-value">$<?= htmlspecialchars(number_format($reportData['totalFines'], 2)) ?></span>
        </div>
    </div>
</body>
</html>