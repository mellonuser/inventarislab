<?php
include 'koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];

$update = $koneksi->query("UPDATE KATEGORI SET NAMAKATEGORI = '$nama' WHERE IDKATEGORI = $id");

if ($update) {
  echo "<script>alert('Kategori diperbarui'); window.location='kategori.php';</script>";
} else {
  echo "Gagal edit: " . $koneksi->error;
}
