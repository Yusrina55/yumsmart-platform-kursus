<?php
include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Query untuk menghapus paket dengan ID yang diberikan
    $sql = "DELETE FROM kelas WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Paket berhasil dihapus!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
