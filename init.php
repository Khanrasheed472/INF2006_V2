<?php
session_start();
include_once '/var/www/inc/dbinfo.inc'; // Adjust the path as necessary

try {
    // Establish a new PDO connection using RDS details from dbinfo.inc
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE . ";charset=utf8", DB_USERNAME, DB_PASSWORD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    // Include your class definitions after establishing the PDO connection
    include_once 'Base.php';
    include_once 'User.php'; // Adjust paths as necessary for your class files
    include_once 'Expense.php';
    include_once 'Budget.php';

    // Initialize objects with the PDO connection
    $getFromU = new User($pdo);
    $getFromB = new Budget($pdo);
    $getFromE = new Expense($pdo);

    // Define BASE_URL if needed
    define("BASE_URL", "http://52.201.24.42/INF2006_V2/index.php"); // Adjust as necessary

} catch (PDOException $e) {
    die("Connection error: " . $e->getMessage());
}
?>
