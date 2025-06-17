<?php
include 'koneksi.php';

$idpinjam = $_GET['id'];
$tanggalKembali = date("Y-m-d H:i:s");

// Insert ke tabel pengembalian
$insert = $koneksi->query("INSERT INTO PENGEMBALIAN (IDPINJAM, TANGGALKEMBALI) VALUES ($idpinjam, '$tanggalKembali')");

// Ambil ID barang terkait
$getBarang = $koneksi->query("SELECT IDBARANG FROM BARANG WHERE IDPINJAM = $idpinjam");
$barang = $getBarang->fetch_assoc();
$idbarang = $barang['IDBARANG'];

// Update BARANG set IDPINJAM = NULL
$update = $koneksi->query("UPDATE BARANG SET IDPINJAM = NULL WHERE IDBARANG = $idbarang");

if ($insert && $update) {
  echo "<script>alert('Barang dikembalikan'); window.location='peminjaman.php';</script>";
} else {
  echo "Gagal: " . $koneksi->error;
}
