<?php
include 'koneksi.php';

$id     = $_POST['idbarang'];
$nama   = $_POST['namabarang'];
$idkat  = $_POST['idkategori'];
$jumlah = $_POST['jumlahbarang'];

$query = $koneksi->query("
  UPDATE BARANG 
  SET NAMABARANG = '$nama', IDKATEGORI = $idkat, JUMLAHBARANG = $jumlah
  WHERE IDBARANG = $id
");

if ($query) {
  echo "<script>alert('Data berhasil diperbarui'); window.location='daftarBarang.php';</script>";
} else {
  echo "Gagal update: " . $koneksi->error;
}
