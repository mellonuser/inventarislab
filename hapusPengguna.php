<?php
include 'koneksi.php';

$id = $_GET['id'];

$hapus = $koneksi->query("DELETE FROM USERS WHERE IDUSER = $id");

if ($hapus) {
  echo "<script>alert('Pengguna dihapus'); window.location='pengguna.php';</script>";
} else {
  echo "Gagal hapus: " . $koneksi->error;
}
