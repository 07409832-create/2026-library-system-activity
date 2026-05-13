<?php declare(strict_types=1); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Library Books</title>
</head>
<body>
    <h1>Library Books</h1>
    
    <nav>
        <p><a href="/2026-library-system-activity/public/index.php">← Back to Home</a></p>
        <p><a href="/2026-library-system-activity/public/index.php?act=add">Add New Book</a></p>
        <p><a href="/2026-library-system-activity/public/index.php?act=search">Search Books</a></p>
        <p><a href="/2026-library-system-activity/public/index.php?act=borrow">Borrow Book</a></p>
        <p><a href="/2026-library-system-activity/public/index.php?act=overdue">View Overdue Books</a></p>
        <p><a href="/2026-library-system-activity/public/index.php?act=report">Generate Report</a></p>
    </nav>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Year</th>
                <th>Genre</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
            <tr>
                <td><?= htmlspecialchars((string) $book['book_id']) ?></td>
                <td><?= htmlspecialchars($book['title']) ?></td>
                <td><?= htmlspecialchars($book['author']) ?></td>
                <td><?= htmlspecialchars((string) $book['year']) ?></td>
                <td><?= htmlspecialchars($book['genre']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>