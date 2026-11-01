<?php
header("Content-Type: application/json");
require_once "koneksi.php";

$id = intval($_POST['id'] ?? 0);

if ($id <= 0) {
    echo json_encode(["success" => false, "message" => "ID tidak valid"]);
    exit;
}

$stmt = $conn->prepare("DELETE FROM pemesanan WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Berhasil dihapus"]);
} else {
    echo json_encode(["success" => false, "message" => "Gagal menghapus data"]);
}

$stmt->close();
$conn->close();
?>