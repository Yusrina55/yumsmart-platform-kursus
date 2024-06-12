<?php
include 'connection.php';

// Ambil data dari formulir tambah-paket.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_paket = $_POST['nama_paket'];
    $harga_paket = $_POST['harga_paket'];
    $durasi_paket = $_POST['durasi_paket'];
    $fitur_paket = $_POST['fitur_paket'];

    // Validasi data
    if (empty($nama_paket) || empty($harga_paket) || empty($durasi_paket) || empty($fitur_paket)) {
        echo "<script>alert('Semua kolom harus diisi'); window.location.href = 'tambah-paket.php';</script>";
        exit;
    }

    // Query SQL untuk menyimpan data ke dalam database
    $sql = "INSERT INTO kelas (nama, harga, durasi, fitur) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    // Bind parameter ke query
    $stmt->bind_param("ssss", $nama_paket, $harga_paket, $durasi_paket, $fitur_paket);

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>alert('Paket berhasil ditambahkan!'); window.location.href = 'kelas-admin.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menambahkan paket: " . $conn->error . "'); window.location.href = 'tambah-paket.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    // Jika tidak ada request POST, redirect ke halaman tambah-paket.php
    header("Location: tambah-paket.php");
    exit;
}
?>
