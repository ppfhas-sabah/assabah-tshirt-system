<?php
header("Content-Type: application/json");
require_once "koneksi.php";

$id          = intval($_POST['id'] ?? 0);
$nama        = $_POST['nama'] ?? '';
$ukuran      = $_POST['ukuran'] ?? 'M';
$type_lengan = $_POST['type_lengan'] ?? 'Pendek';
$jumlah      = intval($_POST['jumlah'] ?? 1);

if ($id <= 0 || empty($nama)) {
    echo json_encode(["success" => false, "message" => "Data tidak valid"]);
    exit;
}

$stmt = $conn->prepare("UPDATE pemesanan SET nama = ?, ukuran = ?, type_lengan = ?, jumlah = ? WHERE id = ?");
$stmt->bind_param("sssii", $nama, $ukuran, $type_lengan, $jumlah, $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Berhasil diupdate"]);
} else {
    echo json_encode(["success" => false, "message" => "Gagal update database"]);
}

$stmt->close();
$conn->close();
?>