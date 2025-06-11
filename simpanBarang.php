<?php
include 'koneksi.php';

$nama     = $_POST['namabarang'];
$idkat    = $_POST['idkategori'];
$jumlah   = $_POST['jumlahbarang'];
$iduser   = $_POST['iduser'];
$idadmin  = $_POST['idadmin'];

$query = $koneksi->query("
  INSERT INTO BARANG (NAMABARANG, IDKATEGORI, JUMLAHBARANG, IDUSER, IDADMIN)
  VALUES ('$nama', $idkat, $jumlah, $iduser, $idadmin)
");

if ($query) {
  echo "<script>alert('Barang berhasil ditambahkan'); window.location='daftarBarang.php';</script>";
} else {
  echo "Gagal menambahkan barang: " . $koneksi->error;
}
