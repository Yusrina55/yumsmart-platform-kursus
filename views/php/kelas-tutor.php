<?php
session_save_path('D:\php_sessions'); // Pastikan direktori ini ada dan dapat ditulis oleh PHP
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id'])) {
    echo "User tidak terautentikasi.";
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil data kelas berdasarkan level pengguna
$sql = "SELECT k.nama AS kelas, d.materi, d.keterangan, d.gambar
        FROM detail_kelas d
        JOIN kelas k ON d.kelas_id = k.id
        WHERE k.id = '$user_id'";
$result = $conn->query($sql);

if ($result === false) {
    echo "Error pada query SQL: " . $conn->error;
    exit();
}

// Simpan hasil query ke dalam array
$kelas = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $kelas[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YUMSMART | KELAS</title>
    <link href="../css/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="flex h-screen bg-gray-50">
        <!-- sidebar -->
        <div class="hidden md:flex flex-col w-64 bg-slate-200">
            <div class="flex items-center justify-center h-16 bg-white shadow-sm">
                <img alt="logo" class="w-[40%] max-h-full" src="../image/logo nama.png">
            </div>
            <div class="flex flex-col flex-1 overflow-y-auto">
                <nav class="flex-1 px-2 py-4 bg-white shadow-sm">
                    <a href="jadwal-tutor.php" class="flex items-center px-4 py-2 text-slate-900 hover:bg-yellow-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        Jadwal
                    </a>
                    <a href="kelas-tutor.php" class="flex items-center px-4 py-2 mt-2 text-slate-900 hover:bg-yellow-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Kelas
                    </a>
                    <a href="report-tutor.html" class="flex items-center px-4 py-2 mt-2 text-slate-900 hover:bg-yellow-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Report
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main content -->
        <div class="flex flex-col flex-1 overflow-y-auto">
            <div class="flex items-center justify-between h-16 bg-white border-b border-gray-200">
                <div class="flex items-center px-4">
                </div>
            </div>
            <div class="flex flex-wrap items-center justify-between mb-8 p-4">
                <h2 class="mr-10 text-xl font-semibold leading-none md:text-5xl sm:text-xl">
                    Kelas
                </h2>
            </div>

            <!-- konten materi berdasarkan level pengguna -->
            <?php if (!empty($kelas)): ?>
                <?php foreach ($kelas as $item): ?>
                    <div class="py-2 px-4 ">
                        <h1 class="text-lg font-semibold py-2 px-4 rounded-lg bg-yellow-300 text-gray-900"><?php echo htmlspecialchars($item['kelas']); ?></h1>
                    </div>
                    <ul class="grid grid-cols-1 xl:grid-cols-3 gap-y-10 gap-x-6 items-start p-8">
                        <li class="relative flex flex-col sm:flex-row xl:flex-col items-start">
                            <div class="order-1 sm:ml-6 xl:ml-0">
                                <h3 class="mb-1 text-slate-900 font-semibold">
                                    <span class="mb-1 block text-sm leading-6 text-indigo-500"><?php echo htmlspecialchars($item['kelas']); ?></span>
                                    <?php echo htmlspecialchars($item['materi']); ?>
                                </h3>
                                <div class="prose prose-slate prose-sm text-slate-600">
                                    <p><?php echo htmlspecialchars($item['keterangan']); ?></p>
                                </div>
                            </div>
                            <img src="<?php echo htmlspecialchars($item['gambar']); ?>" alt="" class="mb-6 shadow-md rounded-lg bg-slate-50 w-full sm:w-[17rem] sm:mb-0 xl:mb-6 xl:w-full" width="1216" height="640">
                        </li>
                    </ul>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="py-2 px-4">
                    <h1 class="text-lg font-semibold py-2 px-4 rounded-lg bg-yellow-300 text-gray-900">Tidak ada kelas yang ditemukan.</h1>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
