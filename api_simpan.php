<?php
header("Content-Type: application/json");
require_once "koneksi.php";

$nama        = $_POST['nama'] ?? '';
$no_wa       = $_POST['no_wa'] ?? '';
$ukuran      = $_POST['ukuran'] ?? 'M';
$type_lengan = $_POST['type_lengan'] ?? 'Pendek';
$jumlah      = intval($_POST['jumlah'] ?? 1);

if (empty($nama) || empty($no_wa)) {
    echo json_encode(["success" => false, "message" => "Nama dan No WA wajib diisi"]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO pemesanan (nama, no_wa, ukuran, type_lengan, jumlah) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $nama, $no_wa, $ukuran, $type_lengan, $jumlah);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Berhasil disimpan"]);
} else {
    echo json_encode(["success" => false, "message" => "Gagal simpan ke database"]);
}

$stmt->close();
$conn->close();
?>