<?php

class Koneksi {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "yumssmart";
    public $koneksi;

    // Metode untuk membuat koneksi ke database
    public function __construct() {
        $this->koneksi = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->koneksi->connect_error) {
            die("Koneksi ke database gagal: " . $this->koneksi->connect_error);
        }
    }

    // Metode untuk mengambil data siswa
    public function getDataSiswa() {
        $query = "SELECT ds.*, k.nama
                FROM data_siswa ds 
                JOIN pembelian p ON ds.id = p.id_siswa 
                JOIN kelas k ON p.id_kelas = k.id";
        $result = $this->koneksi->query($query);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    // Metode untuk mengambil data tutor
    public function getDataTutor() {
        $query = "SELECT dt.*, k.nama as nama_kelas FROM detail_tutor dt JOIN kelas k ON dt.kelas_id = k.id";
        $result = $this->koneksi->query($query);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

}
?>
