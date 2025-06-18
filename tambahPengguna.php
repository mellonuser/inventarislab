<?php
include 'koneksi.php';
$admin = $koneksi->query("SELECT * FROM ADMIN");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Tambah Pengguna</title>
  <link rel="stylesheet" href="./css/form.css" />
</head>
<body>
<div class="container" style="padding: 30px;">
  <h2>Tambah Pengguna</h2>
  <form action="simpanTambahPengguna.php" method="post">
    <div class="form-group"><label>Nama</label><input type="text" name="nama" required></div>
    <div class="form-group"><label>Username</label><input type="text" name="username" required></div>
    <div class="form-group"><label>Password</label><input type="text" name="password" required></div>
    <div class="form-group">
      <label>Admin</label>
      <select name="idadmin" required>
        <option value="">-- Pilih Admin --</option>
        <?php while($a = $admin->fetch_assoc()): ?>
          <option value="<?= $a['IDADMIN'] ?>"><?= $a['NAMAADMIN'] ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <button type="submit" class="btn">Simpan</button>
  </form>
</div>
</body>
</html>
