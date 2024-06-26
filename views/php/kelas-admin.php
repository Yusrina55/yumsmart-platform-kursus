<?php
include 'connection.php'; // Memasukkan file koneksi ke database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <title>YUMSMART | KELAS</title>
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
            <div class="flex flex-wrap items-center justify-between mb-8 p-4">
                <h2 class="mr-10 text-lg font-semibold leading-none md:text-5xl sm:text-xl">
                    Kelas
                </h2>
                
                <div class="p-4">
                    <a href="tambah-paket.admin.php" 
                    class="block py-2.5 px-6 rounded-lg text-sm font-medium bg-yellow-300 text-gray-900 hover:bg-yellow-400">
                    + Tambah Paket
                </a>
                </div>
            </div>

            <!-- Mengambil data kelas dari database -->
            <?php
            $sql = "SELECT * FROM kelas";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
            <ul class="grid grid-cols-1 xl:grid-cols-3 gap-y-10 gap-x-6 items-start p-8">
                <li class="relative flex flex-col sm:flex-row xl:flex-col items-start">
                    <div class="order-1 sm:ml-6 xl:ml-0">
                        <h3 class="mb-1 text-slate-900 font-semibold">
                            <span class="mb-1 block text-sm leading-6 text-indigo-500"></span><?php echo $row['nama']; ?>
                        </h3>
                        
                        <p class="mb-2 text-sm text-slate-600">Harga: <?php echo $row['harga']; ?></p>
                        <p class="mb-2 text-sm text-slate-600">Durasi: <?php echo $row['durasi']; ?></p>
                        <p class="mb-2 text-sm text-slate-600">Fitur: <?php echo $row['fitur']; ?></p>
                        <!-- Tautan Edit -->
                        <a
                            class="group inline-flex items-center h-9 rounded-full text-sm font-semibold whitespace-nowrap px-3 focus:outline-none focus:ring-2 bg-slate-100 text-slate-700 hover:bg-slate-200 hover:text-slate-900 focus:ring-slate-500 mt-6"
                            href="edit-paket-admin.php?id=<?php echo $row['id']; ?>">Edit Paket
                            <svg class="overflow-visible ml-3 text-slate-300 group-hover:text-slate-400"
                                width="3" height="6" viewBox="0 0 3 6" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M0 0L3 3L0 6"></path>
                            </svg>
                        </a>
                        <!-- Tombol Hapus -->
                        <button onclick="hapusPaket(<?php echo $row['id']; ?>)"
                            class="group inline-flex items-center h-9 rounded-full text-sm font-semibold whitespace-nowrap px-3 focus:outline-none focus:ring-2 bg-red-400 text-slate-700 hover:bg-red-500 hover:text-slate-900 focus:ring-slate-500 mt-6">Hapus
                            Paket
                        </button>


                    </div>
                </li>
                <?php
                    }
                }
                ?>
            </ul>
            <?php
            ?>
        </div>        
    </div>
<script>
    function hapusPaket(id) {
        if (confirm("Apakah Anda yakin ingin menghapus paket ini?")) {
            // Mengirimkan permintaan AJAX untuk menghapus paket
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert("Paket berhasil dihapus!");
                    window.location.reload(); // Memuat ulang halaman setelah penghapusan berhasil
                }
            };
            xhr.open("GET", "hapus-paket-admin.php?id=" + id, true);
            xhr.send();
        }
    }
</script>

</body>
</html>
