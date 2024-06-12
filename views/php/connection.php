<?php
// Konfigurasi database
$servername = "localhost";
$username = "yumssmart";
$password = "yumssmart";
$dbname = "yumssmart";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
