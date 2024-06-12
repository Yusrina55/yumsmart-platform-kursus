<?php
include 'connection.php';

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
            // Redirect ke halaman jadwal-ada.html
            header("Location: ../ortu/jadwal-ada.html");
            exit();
        } else {
            echo "Anda bukan siswa.";
        }
    } else {
        echo "Email atau password salah.";
    }
}
else {
    echo "Internal server eror bos";
}

$conn->close();
?>
