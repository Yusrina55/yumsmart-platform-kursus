<?php
session_save_path('D:\php_sessions'); // Pastikan direktori ini ada dan dapat ditulis oleh PHP
session_start();
include 'connection.php';

$user_id = $_SESSION['user_id'];

// Query untuk mengambil data jadwal
$sql = "SELECT j.tanggal, j.kelas, dt.nama AS tutor, j.materi, j.link_kelas
          FROM jadwal j
          JOIN detail_tutor dt ON j.tutor_id = dt.id";

$sql = "SELECT j.tanggal, k.nama AS kelas, dt.nama AS tutor, d.materi, j.link_kelas 
        FROM jadwal j
        JOIN kelas k ON j.kelas_id = k.id
        JOIN detail_kelas d ON j.materi_id = d.id
        JOIN detail_tutor dt ON j.detail_tutor_id = dt.id";

$result = $conn->query($sql);

// Periksa apakah ada data yang ditemukan
if ($result->num_rows > 0) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <title>YUMSMART | Jadwal Admin</title>
    <link href="../css/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
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
                    <a href="jadwal-ada-admin.html" class="flex items-center px-4 py-2 text-slate-900 hover:bg-yellow-300  ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        Jadwal
                    </a>
                    <a href="kelas-admin.html" class="flex items-center px-4 py-2 mt-2 text-slate-900 hover:bg-yellow-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Kelas
                    </a>
                    <a href="bukti-pembayaran-admin.html" class="flex items-center px-4 py-2 mt-2 text-slate-900 hover:bg-yellow-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Bukti Pembayaran
                    </a>
                    
                    <a href="list-siswa.html" class="flex items-center px-4 py-2 mt-2 text-slate-900 hover:bg-yellow-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Siswa
                    </a>
                    <a href="list-tutor.html" class="flex items-center px-4 py-2 mt-2 text-slate-900 hover:bg-yellow-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Tutor
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
            <div class="p-4">
                <h1 class="text-2xl font-bold">Jadwal</h1>
            </div>
            <div class="p-4">
                <section class="flex-1 p-6 bg-gray-50 dark:bg-gray-800">
                    <div class="flex flex-col">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-800">
                                            <tr>
                                                <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-gray-900">
                                                    Tanggal
                                                </th>
                                                <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-gray-900">
                                                    Kelas
                                                </th>
                                                <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-gray-900">
                                                    Tutor
                                                </th>
                                                <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-gray-900">
                                                    Materi
                                                </th>
                                                <th scope="col" class="px-4 py-3.5 text-sm font-semibold text-left rtl:text-right text-gray-900">
                                                    Link Kelas
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                            <?php
                                                // Tampilkan data jadwal
                                                while ($row = $result->fetch_assoc()) {
                                                    // Tampilkan baris tabel untuk setiap jadwal
                                                    echo "<tr>";
                                                    echo "<td class='px-4 py-4 text-sm text-white whitespace-nowrap'>" . $row['tanggal'] . "</td>";
                                                    echo "<td class='px-4 py-4 text-sm text-white whitespace-nowrap'>" . $row['kelas'] . "</td>";
                                                    echo "<td class='px-4 py-4 text-sm text-white whitespace-nowrap'>" . $row['tutor'] . "</td>";
                                                    echo "<td class='px-4 py-4 text-sm text-white whitespace-nowrap'>" . $row['materi'] . "</td>";
                                                    echo "<td class='px-4 py-4 text-sm text-blue-500 whitespace-nowrap cursor-pointer'>" . $row['link_kelas'] . "</td>";
                                                    echo "</tr>";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>
</html>
<?php
} else {
    // Jika tidak ada data jadwal ditemukan
    echo "Belum ada jadwal.";
}

// Tutup koneksi ke database
$conn->close();
?>
