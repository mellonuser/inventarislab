<?php
include 'koneksi.php';

$users = $koneksi->query("SELECT * FROM USERS");
$barang = $koneksi->query("SELECT * FROM BARANG WHERE IDPINJAM IS NULL");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Peminjaman Baru</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div class="container" style="padding: 30px;">
  <h2>Form Peminjaman</h2>
  <form action="simpanPinjam.php" method="post">
    <div class="form-group">
      <label>Peminjam</label>
      <select name="iduser" required>
        <option value="">-- Pilih User --</option>
        <?php while($u = $users->fetch_assoc()): ?>
          <option value="<?= $u['IDUSER'] ?>"><?= $u['NAMAUSER'] ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="form-group">
      <label>Barang</label>
      <select name="idbarang" required>
        <option value="">-- Pilih Barang --</option>
        <?php while($b = $barang->fetch_assoc()): ?>
          <option value="<?= $b['IDBARANG'] ?>"><?= $b['NAMABARANG'] ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="form-group">
      <label>Tanggal Pinjam</label>
      <input type="datetime-local" name="tanggalpinjam" required>
    </div>
    <button type="submit" class="btn">Catat Peminjaman</button>
  </form>
</div>
</body>
</html>
