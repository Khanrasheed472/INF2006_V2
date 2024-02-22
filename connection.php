<?php

include_once '/var/www/inc/dbinfo.inc'; // Use include_once to avoid redefining constants

try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection error: " . $e->getMessage();
    exit; // Add exit to halt script execution upon error
}
?>