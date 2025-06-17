<?php
include 'koneksi.php';

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$idadmin = $_POST['idadmin'];

$simpan = $koneksi->query("INSERT INTO USERS (NAMAUSER, USERNAME, PASSWORD, IDADMIN) VALUES ('$nama', '$username', '$password', $idadmin)");

if ($simpan) {
  echo "<script>alert('Pengguna ditambahkan'); window.location='pengguna.php';</script>";
} else {
  echo "Gagal simpan: " . $koneksi->error;
}
