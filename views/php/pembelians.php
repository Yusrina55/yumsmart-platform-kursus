<?php
include 'connection.php';

$sql = "SELECT pembelian.id, data_siswa.nama, data_siswa.email, data_siswa.no_telp, kelas.nama AS nama_kelas
        FROM pembelian
        JOIN data_siswa ON pembelian.data_siswa_uname = data_siswa.uname
        JOIN kelas ON pembelian.kelas_id = kelas.id";
$result = $conn->query($sql);

$siswa_list = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $siswa_list[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($siswa_list);

$conn->close();
?>
