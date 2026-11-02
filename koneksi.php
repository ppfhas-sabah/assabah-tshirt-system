<?php
// Membaca kredensial dari Environment Variables (Environment Hosting)
$host = getenv('DB_HOST') ?: "mysql-3f4a3eb3-fathulhidayahassabah-d9d8.f.aivencloud.com";
$user = getenv('DB_USER') ?: "avnadmin";
$pass = getenv('DB_PASS'); // Password diambil dari Environment Variable server
$db   = getenv('DB_NAME') ?: "defaultdb";
$port = getenv('DB_PORT') ?: 21306;

$conn = mysqli_init();
$conn->ssl_set(NULL, NULL, NULL, NULL, NULL);

$koneksi_berhasil = $conn->real_connect($host, $user, $pass, $db, $port, NULL, MYSQLI_CLIENT_SSL);

if (!$koneksi_berhasil || $conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Koneksi Gagal: " . $conn->connect_error]));
}

$conn->set_charset("utf8");
?>
