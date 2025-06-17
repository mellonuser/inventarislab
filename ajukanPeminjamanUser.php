<?php
session_start();
include 'koneksi.php';

$iduser = $_SESSION['iduser'];
$idbarang = $_POST['idbarang'];
$tanggal = $_POST['tanggalpinjam'];

$insert = $koneksi->query("INSERT INTO PEMINJAMAN (IDUSER, TANGGALPINJAM) VALUES ($iduser, '$tanggal')");
$idpinjam = $koneksi->insert_id;

$update = $koneksi->query("UPDATE BARANG SET IDPINJAM = $idpinjam WHERE IDBARANG = $idbarang");

if ($insert && $update) {
  echo "<script>alert('Peminjaman berhasil diajukan!'); window.location='dashboardUser.php';</script>";
} else {
  echo "Gagal meminjam: " . $koneksi->error;
}