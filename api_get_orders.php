<?php
header("Content-Type: application/json");
require_once "koneksi.php";

$sql = "SELECT id, nama, no_wa, ukuran, type_lengan, jumlah FROM pemesanan ORDER BY id DESC";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = [
            "id" => intval($row["id"]),
            "nama" => $row["nama"],
            "no_wa" => $row["no_wa"] ?? '-',
            "ukuran" => $row["ukuran"],
            "type_lengan" => $row["type_lengan"],
            "jumlah" => intval($row["jumlah"])
        ];
    }
}

echo json_encode(["success" => true, "data" => $data]);
$conn->close();
?>