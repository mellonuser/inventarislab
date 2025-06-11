<?php
include 'koneksi.php';

$nama = $_POST['nama'];
$simpan = $koneksi->query("INSERT INTO KATEGORI (NAMAKATEGORI) VALUES ('$nama')");

if ($simpan) {
  echo "<script>alert('Kategori ditambahkan'); window.location='kategori.php';</script>";
} else {
  echo "Gagal menambah: " . $koneksi->error;
}
