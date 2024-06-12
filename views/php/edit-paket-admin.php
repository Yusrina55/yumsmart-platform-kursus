<?php
include 'connection.php';

// Pastikan ID dikirimkan dari halaman sebelumnya
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data paket berdasarkan ID
    $sql = "SELECT * FROM kelas WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Simpan data dalam variabel untuk diisi ke dalam form
        $nama = $row['nama'];
        $harga = $row['harga'];
        $durasi = $row['durasi'];
        $fitur = $row['fitur'];
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}

// Proses perubahan data jika form di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $nama_paket = $_POST['nama'];
    $harga_paket = $_POST['harga'];
    $durasi_paket = $_POST['durasi'];
    $fitur_paket = $_POST['fitur'];

    // Query untuk meng-update data paket ke database
    $sql_update = "UPDATE kelas SET nama='$nama_paket', harga='$harga_paket', durasi='$durasi_paket', fitur='$fitur_paket' WHERE id=$id";

    if ($conn->query($sql_update) === TRUE) {
        echo "Data paket berhasil diperbarui!";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <title>YUMSMART | Edit Paket</title>
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
                    <a href="jadwal-ada-admin.html" class="flex items-center px-4 py-2 text-slate-900 hover:bg-yellow-300">
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
            <div class="p-4">
                <h1 class="text-2xl font-bold">Edit Paket</h1>
            </div>
            <div class="container mx-auto p4-10">
                <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden md:max-w-xl">
                    <div class="md:flex">
                        <div class="w-full px-6 py-8 md:p-8">
                            <form method="POST" action="">
                                <div class="mb-6">
                                    <label class="block text-gray-800 font-bold mb-2" for="nama">
                                        Nama Paket
                                    </label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama" name="nama" type="text" placeholder="Masukkan nama" value="<?php echo $nama; ?>">
                                </div>
                                <div class="mb-6">
                                    <label class="block text-gray-800 font-bold mb-2" for="harga">
                                        Harga Paket
                                    </label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="harga" name="harga" type="text" placeholder="Masukkan harga" value="<?php echo $harga; ?>">
                                </div>
                                <div class="mb-6">
                                    <label class="block text-gray-800 font-bold mb-2" for="durasi">
                                        Durasi Paket
                                    </label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="durasi" name="durasi" type="text" placeholder="Masukkan durasi" value="<?php echo $durasi; ?>">
                                </div>
                                <div class="mb-6">
                                    <label class="block text-gray-800 font-bold mb-2" for="fitur">
                                        Fitur Paket
                                    </label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fitur" name="fitur" type="text" placeholder="Masukkan fitur" value="<?php echo $fitur; ?>">
                                </div>
                                <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Submit
                                </button>
                                <a href="kelas-admin.html" class="ml-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Cancel
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

