<?php
include "/var/www/inc/dbinfo.inc"; // Adjust the path as necessary to where your dbinfo.inc is located.

// Using the constants from dbinfo.inc for the DSN
$dsn = "mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE . ";charset=utf8mb4"; // Added charset for better support
$user = DB_USERNAME;
$pass = DB_PASSWORD;

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Turn on error mode exception for better debugging
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Set default fetch mode to associative array
        PDO::ATTR_EMULATE_PREPARES => false, // Turn off emulation mode for prepared statements
    ]);
} catch(PDOException $e) {
    echo "Connection Error! " . $e->getMessage();
}
?>
