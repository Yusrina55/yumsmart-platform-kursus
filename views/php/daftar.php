<?php
include 'connection.php';

// Mengecek apakah request metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data dari form
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $no_telp = $_POST['no_telp'];

    // Validasi panjang email
    if (strlen($email) < 12) {
        die("Email harus memiliki minimal 12 karakter.");
    }

    // Validasi panjang nomor telepon
    if (strlen($no_telp) < 8) {
        die("Nomor telepon harus memiliki minimal 8 karakter.");
    }

    // Validasi panjang password dan tidak mengandung spasi
    if (strlen($password) < 8 || strpos($password, ' ') !== false) {
        die("Password harus memiliki minimal 8 karakter dan tidak mengandung spasi.");
    }

    // Memasukkan data ke tabel data_siswa dan users
    $sql1 = "INSERT INTO data_siswa (uname, email, password, no_telp) VALUES ('$uname', '$email', '$password', '$no_telp')";
    $sql2 = "INSERT INTO users (uname, password) VALUES ('$uname', '$password')";

    if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
        // Mengarahkan ke halaman masuk.html setelah pendaftaran berhasil
        header("Location: ../ortu/masuk.html");
        exit();
    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
        echo "Error: " . $sql2 . "<br>" . $conn->error;
        echo "ada kesalahan server ni bwos";
    }

    $conn->close();
} else {
    echo "Invalid request method ni bwos";
}
?>
