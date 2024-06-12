<?php
include 'connection.php';
session_save_path('D:\php_sessions');
session_start(); // Mulai sesi untuk mendapatkan user_id

if (!isset($_SESSION['user_id'])) {
    die("Anda harus login untuk melakukan pembelian.");
}

$kelasNama = isset($_GET['kelas']) ? $_GET['kelas'] : '';

$sql = "SELECT * FROM kelas WHERE LOWER(nama) = '$kelasNama'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $kelas = $result->fetch_assoc();
} else {
    die("Kelas tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simpan data pembelian ke database
    $user_id = $_SESSION['user_id']; // Ambil ID pengguna dari sesi
    $kelas_id = $kelas['id']; // ID kelas dari hasil query
    $tanggalPembelian = date('Y-m-d H:i:s'); // Tanggal dan waktu pembelian
    
    $sqlInsert = "INSERT INTO pembelian (id_siswa, id_kelas, tanggal_pembelian) VALUES ('$user_id', '$kelas_id', '$tanggalPembelian')";
    
    if ($conn->query($sqlInsert) === TRUE) {
        header("Location: jadwal-ada.php");
        exit;
    } else {
        echo "Error: " . $sqlInsert . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YUMSMART | <?php echo ucfirst($kelasNama); ?></title>
    <link href="../css/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body class="font-inter">
    <div class="bg-gray-100 h-screen py-8">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl font-semibold mb-4">Review</h1>
            <div class="flex flex-col md:flex-row gap-4">
                <div class="md:w-3/4">
                    <div class="bg-white rounded-lg shadow-md p-6 mb-4">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="text-left font-semibold">Paket</th>
                                    <th class="text-left font-semibold">Harga</th>                                  
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-4">
                                        <div class="flex items-center">
                                            <img class="h-16 w-30 mr-4" src="../image/head.jpeg" alt="Product image">
                                            <span class="font-semibold"><?php echo ucfirst($kelasNama); ?></span>
                                        </div>
                                    </td>
                                    <td class="py-4">Rp<?php echo number_format($kelas['harga'], 2, ',', '.'); ?></td>                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="md:w-1/4">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-lg font-semibold mb-4">Summary</h2>
                        <div class="flex justify-between mb-2">
                            <span>Subtotal</span>
                            <span>Rp<?php echo number_format($kelas['harga'], 2, ',', '.'); ?></span>
                        </div>
                        <hr class="my-2">
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Total</span>
                            <span class="font-semibold">Rp<?php echo number_format($kelas['harga'], 2, ',', '.'); ?></span>
                        </div>
                        <div class="text-center pt-6">
                            <form method="POST" action="beli.php?kelas=<?php echo urlencode($kelasNama); ?>">
                                <button type="submit" class="bg-yellow-400 text-white py-2 px-4 rounded-lg mt-4 w-full hover:bg-yellow-500">Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
