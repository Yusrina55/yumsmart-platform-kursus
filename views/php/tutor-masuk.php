<?php
include 'connection.php';
session_save_path('D:\php_sessions'); // Pastikan direktori ini ada dan dapat ditulis oleh PHP
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data dari form
    $uname = $_POST['uname'];
    $password = $_POST['password'];

    $sql_tutor = "SELECT * FROM users WHERE uname='$uname' AND password='$password'";
    $result_tutor = $conn->query($sql_tutor);
    
    // Memeriksa apakah username mengandung kata 'tutor'
    if (strpos($uname, 'tutor') !== false && $result_tutor->num_rows > 0) {
        // Mengecek apakah data masuk ada di tabel users
        // Mengecek apakah data masuk ada di tabel users dan detail_tutor
        $sql = "SELECT * FROM detail_tutor WHERE nama='$uname'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Simpan data pengguna di sesi
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['nama'];
            // Redirect ke halaman jadwal-ada.html jika data cocok
            header("Location: jadwal-tutor.php");
            exit();
        } else {
            echo "Username atau password salah.";
        }
    } else {
        echo "<script>alert('Jika anda bukan tutor silakan login sebagai siswa');</script>";
    }
}
else {
    echo "Internal server eror yaa";
}

$conn->close();
?>
