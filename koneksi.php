<?php
$host     = "localhost";
$user     = "root";
$password = ""; // ganti jika ada password
$database = "pemweb3";

// Membuat koneksi
$koneksi = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
