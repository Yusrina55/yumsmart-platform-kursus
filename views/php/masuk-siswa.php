<?php
include 'connection.php';
session_save_path('D:\php_sessions'); // Pastikan direktori ini ada dan dapat ditulis oleh PHP
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data dari form
    $username = $_POST['uname'];
    $password = $_POST['password'];

    // Mengecek apakah data masuk ada di tabel users dan data_siswa
    $sql = "SELECT * FROM users WHERE uname='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sql_siswa = "SELECT * FROM data_siswa WHERE uname='$username' AND password='$password'";
        $result_siswa = $conn->query($sql_siswa);
        if ($result_siswa->num_rows > 0) {
            // Simpan data pengguna di sesi
            $user = $result_siswa->fetch_assoc();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['uname'];

            // Redirect ke halaman jadwal-ada.php
            header("Location: ../php/jadwal-ada.php");
            exit();
        } else {
            echo "Anda bukan siswa.";
        }
    } else {
        echo "Email atau password salah.";
    }
} else {
    echo "Internal server error.";
}

$conn->close();
?>
