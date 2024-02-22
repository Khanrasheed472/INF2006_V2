<?php
session_start();
include_once '/var/www/inc/dbinfo.inc'; // Corrected path

try {
    // Establish a new PDO connection using RDS details from dbinfo.inc
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    // Include class definitions
    include_once __DIR__ . '/base.php';
    include_once __DIR__ . '/bser.php';
    include_once __DIR__ . '/bxpense.php';
    include_once __DIR__ . '/budget.php';

    // Initialize objects with the PDO connection
    $getFromU = new User($pdo);
    $getFromB = new Budget($pdo);
    $getFromE = new Expense($pdo);

} catch (PDOException $e) {
    die("Connection error: " . $e->getMessage());
}
?>
