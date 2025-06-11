<?php
include 'koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$idadmin = $_POST['idadmin'];

$update = $koneksi->query("UPDATE USERS SET NAMAUSER='$nama', USERNAME='$username', PASSWORD='$password', IDADMIN=$idadmin WHERE IDUSER=$id");

if ($update) {
  echo "<script>alert('Data pengguna diperbarui'); window.location='pengguna.php';</script>";
} else {
  echo "Gagal edit: " . $koneksi->error;
}
