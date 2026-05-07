<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/Config/DatabaseConfig.php';
require_once __DIR__ . '/../src/Config/LibraryConfig.php';
require_once __DIR__ . '/../src/Exception/DatabaseException.php';
require_once __DIR__ . '/../src/Exception/ValidationException.php';
require_once __DIR__ . '/../src/Entity/Book.php';
require_once __DIR__ . '/../src/Library/DatabaseConnection.php';
require_once __DIR__ . '/../src/Repository/BookRepository.php';
require_once __DIR__ . '/../src/Repository/BorrowRepository.php';
require_once __DIR__ . '/../src/Service/LibraryService.php';

use App\Library\DatabaseConnection;
use App\Service\LibraryService;

$connection = new DatabaseConnection();
$libraryService = new LibraryService($connection);

$action = $_GET['act'] ?? '';

switch ($action) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $bookId = $libraryService->addBook(
                    $_POST['title'] ?? '',
                    $_POST['author'] ?? '',
                    (int) ($_POST['year'] ?? 0),
                    $_POST['genre'] ?? ''
                );
                echo "<h2>Book added successfully with ID: $bookId</h2>";
                echo '<p><a href="?act=list">View all books</a></p>';
            } catch (Exception $e) {
                echo "<h2>Error adding book:</h2>";
                echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
            }
        } else {
            include __DIR__ . '/../src/View/borrow_form.php';
        }
        break;
        
    case 'list':
        $books = $libraryService->getAllBooks();
        include __DIR__ . '/../src/View/book_list.php';
        break;
        
    case 'search':
        $keyword = $_GET['keyword'] ?? '';
        if ($keyword) {
            $books = $libraryService->searchBooks($keyword);
            include __DIR__ . '/../src/View/book_list.php';
        } else {
            echo '<h2>Search Books</h2>';
            echo '<form method="get">';
            echo '<input type="hidden" name="act" value="search">';
            echo '<input type="text" name="keyword" placeholder="Enter title or author..." required>';
            echo '<button type="submit">Search</button>';
            echo '</form>';
        }
        break;
        
    case 'borrow':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $recordId = $libraryService->borrowBook(
                    (int) ($_POST['student_id'] ?? 0),
                    (int) ($_POST['book_id'] ?? 0),
                    (int) ($_POST['days'] ?? 14)
                );
                echo "<h2>Book borrowed successfully! Record ID: $recordId</h2>";
                echo '<p><a href="?act=list">View all books</a></p>';
            } catch (Exception $e) {
                echo "<h2>Error borrowing book:</h2>";
                echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
            }
        } else {
            include __DIR__ . '/../src/View/borrow_form.php';
        }
        break;
        
    case 'return':
        $recordId = (int) ($_GET['record_id'] ?? 0);
        if ($recordId > 0) {
            try {
                $fine = $libraryService->returnBook($recordId);
                echo "<h2>Book returned successfully!</h2>";
                if ($fine > 0) {
                    echo "<p>Fine charged: $" . number_format($fine, 2) . "</p>";
                } else {
                    echo "<p>No fine charged (returned on time)</p>";
                }
                echo '<p><a href="?act=list">View all books</a></p>';
            } catch (Exception $e) {
                echo "<h2>Error returning book:</h2>";
                echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
            }
        } else {
            echo '<h2>Invalid record ID</h2>';
        }
        break;
        
    case 'overdue':
        $overdueBooks = $libraryService->getOverdueBooks();
        include __DIR__ . '/../src/View/overdue_list.php';
        break;
        
    case 'report':
        $reportData = $libraryService->generateReportData();
        include __DIR__ . '/../src/View/report_view.php';
        break;
        
    default:
        echo '<!DOCTYPE html>';
        echo '<html><head><title>Library Management System</title></head><body>';
        echo '<h1>Library Management System</h1>';
        echo '<nav>';
        echo '<p><a href="?act=list">📚 List All Books</a></p>';
        echo '<p><a href="?act=add">➕ Add New Book</a></p>';
        echo '<p><a href="?act=search">🔍 Search Books</a></p>';
        echo '<p><a href="?act=borrow">📖 Borrow Book</a></p>';
        echo '<p><a href="?act=overdue">⚠️ View Overdue Books</a></p>';
        echo '<p><a href="?act=report">📊 Generate Report</a></p>';
        echo '</nav>';
        echo '</body></html>';
        break;
}