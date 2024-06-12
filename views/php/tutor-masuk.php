<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data dari form
    $uname = $_POST['uname'];
    $password = $_POST['password'];

    // Memeriksa apakah username mengandung kata 'tutor'
    if (strpos($uname, 'tutor') !== false) {
        // Mengecek apakah data masuk ada di tabel users
        $sql = "SELECT * FROM users WHERE uname='$uname' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Redirect ke halaman jadwal-ada.html jika data cocok
            header("Location: ../tutor/jadwal-tutor.html");
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
