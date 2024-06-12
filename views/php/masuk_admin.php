<?php
include 'connection.php';

// Mengecek apakah request metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data dari form
    $uname = $_POST['uname'];
    $password = $_POST['password'];

    // Memeriksa apakah username dan password cocok dengan data di database
    $sql = "SELECT * FROM users WHERE uname='$uname' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Redirect ke halaman jadwal-ada-admin.html jika data ada di tabel users
        header("Location: ../admin/jadwal-ada-admin.html");
        exit();
    } else {
        echo "Username atau password salah.";
    }
} else {
    echo "Invalid request method ni bwos";
}
?>
