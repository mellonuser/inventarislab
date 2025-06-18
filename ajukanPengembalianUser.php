<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['iduser'])) {
  header("Location: login.php");
  exit();
}

if (!isset($_GET['id'])) {
  echo "ID Peminjaman tidak ditemukan!";
  exit();
}

$idpinjam = intval($_GET['id']);
$tanggalkembali = date('Y-m-d H:i:s');

// Cek apakah sudah pernah dikembalikan
$cek = $koneksi->query("SELECT * FROM PENGEMBALIAN WHERE IDPINJAM = $idpinjam");
if ($cek->num_rows > 0) {
  echo "<script>alert('Barang ini sudah dikembalikan sebelumnya!'); window.location='lamanPengembalianUser.php';</script>";
  exit();
}

// Insert ke tabel pengembalian
$insert = $koneksi->query("INSERT INTO PENGEMBALIAN (IDPINJAM, TANGGALKEMBALI) VALUES ($idpinjam, '$tanggalkembali')");

// Kosongkan IDPINJAM di tabel BARANG
$update = $koneksi->query("UPDATE BARANG SET IDPINJAM = NULL WHERE IDPINJAM = $idpinjam");

if ($insert && $update) {
  echo "<script>alert('Pengembalian berhasil!'); window.location='lamanPengembalianUser.php';</script>";
} else {
  echo "Gagal mengembalikan: " . $koneksi->error;
}
?>
