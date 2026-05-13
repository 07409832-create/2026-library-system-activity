# Student Library Management System

A refactored OOP PHP application for managing library books, borrow records,
and overdue fines. Built following PSR-12 coding standards.

## Author
- Haneen

## Requirements
- PHP 8.0 or higher
- MySQL 5.7 or higher
- Git

## File Structure
```
src/
├── Config/          # Configuration, connectionand constants
│   ├── DatabaseConfig.php
    ├──  DatabaseConnection.php 
│   └── LibraryConfig.php
├── Entity/          # Data models (Book, BorrowRecord, Student)
│   ├── Book.php
│   ├── BorrowRecord.php
│   └── Student.php
├── Repository/      # Database access layer
│   ├── BookRepository.php
│   └── BorrowRepository.php
├── Service/         # Business logic
│   └── LibraryService.php
├── Exception/       # Custom exceptions
│   ├── DatabaseException.php
│   └── ValidationException.php
├── Library/         # Core classes
│   └── DatabaseConnection.php
└── View/            # HTML templates
    ├── book_list.php
    ├── borrow_form.php
    └── report_view.php
public/              # Web-accessible entry point
└── index.php
└── sql.sql for database
docs/                # Generated PHPDoc output

### Adding a Book
```php
$connection = new DatabaseConnection();
$service = new LibraryService($connection);

$bookId = $service->addBook('The Great Gatsby', 'F. Scott Fitzgerald', 1925, 'Fiction');
```

### Borrowing a Book
```php
$service = new LibraryService($connection);
$recordId = $service->borrowBook(101, 42, 14); // student 101 borrows book 42 for 14 days
```

### Searching Books
```php
$books = $service->searchBooks('Gatsby');
```

### Generating Reports
```php
$reportData = $service->generateReportData();
echo "Total Books: " . $reportData['totalBooks'];
```