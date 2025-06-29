<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'kepegawaian');

// Create connection
function getDBConnection() {
    $koneksi = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check connection
    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    $koneksi->set_charset("utf8"); // Set charset di sini
    return $koneksi;
}

// Buat koneksi global langsung
$koneksi = getDBConnection();
?>
