<?php
include 'connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM kelas";
$result = $conn->query($sql);

if ($result === false) {
    die("Error: " . $conn->error);
}

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conn->close();
?>
