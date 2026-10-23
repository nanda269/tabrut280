<?php
// Konfigurasi Database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_sistemmahasiswa";

// Untuk InfinityFree, ganti dengan data dari control panel
// $host = "sqlxxx.epizy.com";
// $user = "epiz_xxx";
// $pass = "your_password";
// $db   = "epiz_xxx_db_sistemmahasiswa";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Base URL
define('BASE_URL', 'http://localhost/sistemmahasiswa/');
?>
