<?php
header("Content-Type: application/json");
require_once "koneksi.php";

$id_pemesanan = $_POST['id_pemesanan'] ?? '';

if (empty($id_pemesanan) || !isset($_FILES['bukti'])) {
    echo json_encode(["success" => false, "message" => "Bukti bayar atau ID tidak ditemukan"]);
    exit;
}

$target_dir = "uploads/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$file_name = time() . "_" . basename($_FILES["bukti"]["name"]);
$target_file = $target_dir . $file_name;

if (move_uploaded_file($_FILES["bukti"]["tmp_name"], $target_file)) {
    $stmt = $conn->prepare("UPDATE pemesanan SET bukti_bayar = ?, status_bayar = 'Menunggu Verifikasi' WHERE id = ?");
    $stmt->bind_param("si", $file_name, $id_pemesanan);
    $stmt->execute();
    $stmt->close();

    echo json_encode(["success" => true, "message" => "Bukti bayar berhasil diunggah", "file" => $file_name]);
} else {
    echo json_encode(["success" => false, "message" => "Gagal mengunggah file"]);
}

$conn->close();
?>