<?php
include 'connection.php';

$kelasNama = isset($_GET['kelas']) ? $_GET['kelas'] : '';

// Pertama, kita harus mendapatkan kelas_id berdasarkan nama kelas
$sqlKelas = "SELECT id FROM kelas WHERE LOWER(nama) = '$kelasNama'";
$resultKelas = $conn->query($sqlKelas);

if ($resultKelas->num_rows > 0) {
    $kelas = $resultKelas->fetch_assoc();
    $kelasId = $kelas['id'];
} else {
    die("Kelas tidak ditemukan.");
}

// Setelah mendapatkan kelas_id, kita dapat mengambil detail kelas
$sqlDetail = "SELECT * FROM detail_kelas WHERE kelas_id = $kelasId";
$resultDetail = $conn->query($sqlDetail);

if ($resultDetail->num_rows > 0) {
    $detailKelas = $resultDetail->fetch_all(MYSQLI_ASSOC);
} else {
    die("Detail kelas tidak ditemukan.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YUMSMART | Pilih Kelas</title>
    <link href="../css/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body class="font-inter">
    <div class="h-screen bg-white dark:bg-gray-900 text-gray-800">
        <div class="container mx-auto px-4 py-8">
            <h2 class="text-3xl font-semibold text-center text-gray-900 mb-8">
                <?php echo strtoupper($kelasNama); ?>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Looping untuk setiap detail kelas -->
                <?php foreach ($detailKelas as $detail) : ?>
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($detail['gambar']); ?>" alt="Gambar Materi" class="w-full h-64 object-cover">
                    <div class="p-4 md:p-6">
                        <h3 class="text-xl font-semibold text-yellow-400 mb-2"><?php echo $detail['materi']; ?></h3>
                        <p class="text-gray-700 dark:text-gray-300 mb-4 two-lines"><?php echo $detail['keterangan']; ?></p>
                        <a href="#" class="inline-block bg-yellow-500 text-sm text-white px-4 py-2 rounded-full">
                            <?php echo $detail['waktu']; ?>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
