<?php
session_start();
include_once __DIR__ . '/../dbinfo.inc'; // Adjust if dbinfo.inc is located elsewhere

try {
    // Establish a new PDO connection
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    // Include class definitions
    include_once __DIR__ . '/Base.php';
    include_once __DIR__ . '/User.php';
    include_once __DIR__ . '/Expense.php';
    include_once __DIR__ . '/Budget.php';

    // Initialize objects
    $getFromU = new User($pdo);
    $getFromB = new Budget($pdo);
    $getFromE = new Expense($pdo);

} catch (PDOException $e) {
    die("Connection error: " . $e->getMessage());
}
?>