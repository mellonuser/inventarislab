<?php
include 'koneksi.php';

// Ambil kategori dan user untuk dropdown
$kategori = $koneksi->query("SELECT * FROM KATEGORI");
$users = $koneksi->query("SELECT * FROM USERS");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Barang</title>
  <link rel="stylesheet" href="./css/style.css" />
</head>
<body>
  <div class="container" style="padding: 30px;">
    <h2>Tambah Barang Baru</h2>
    <form action="simpanBarang.php" method="post">
      <div class="form-group">
        <label>Nama Barang</label>
        <input type="text" name="namabarang" required>
      </div>
      <div class="form-group">
        <label>Kategori</label>
        <select name="idkategori" required>
          <option value="">-- Pilih Kategori --</option>
          <?php while($k = $kategori->fetch_assoc()): ?>
            <option value="<?= $k['IDKATEGORI'] ?>"><?= $k['NAMAKATEGORI'] ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="form-group">
        <label>Jumlah Barang</label>
        <input type="number" name="jumlahbarang" min="1" required>
      </div>
      <div class="form-group">
        <label>User</label>
        <select name="iduser" required>
          <option value="">-- Pilih User --</option>
          <?php while($u = $users->fetch_assoc()): ?>
            <option value="<?= $u['IDUSER'] ?>"><?= $u['NAMAUSER'] ?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="form-group">
        <label>Admin ID</label>
        <input type="number" name="idadmin" required>
      </div>
      <button type="submit" class="btn">Simpan Barang</button>
    </form>
  </div>
</body>
</html>
