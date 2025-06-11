<?php
include 'koneksi.php';

$id = $_GET['id'];

// Cek apakah kategori digunakan di barang
$cek = $koneksi->query("SELECT COUNT(*) AS total FROM BARANG WHERE IDKATEGORI = $id")->fetch_assoc();

if ($cek['total'] > 0) {
  echo "<script>alert('Kategori tidak dapat dihapus karena masih digunakan barang'); window.location='kategori.php';</script>";
} else {
  $hapus = $koneksi->query("DELETE FROM KATEGORI WHERE IDKATEGORI = $id");
  if ($hapus) {
    echo "<script>alert('Kategori dihapus'); window.location='kategori.php';</script>";
  } else {
    echo "Gagal hapus: " . $koneksi->error;
  }
}
