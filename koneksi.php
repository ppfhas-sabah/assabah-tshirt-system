<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_seragam";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Koneksi Gagal: " . $conn->connect_error]));
}
$conn->set_charset("utf8");
?>