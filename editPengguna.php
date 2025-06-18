<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = $koneksi->query("SELECT * FROM USERS WHERE IDUSER = $id")->fetch_assoc();
$admin = $koneksi->query("SELECT * FROM ADMIN");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Pengguna</title>
  <link rel="stylesheet" href="./css/form.css">
</head>
<body>
<div class="container" style="padding: 30px;">
  <h2>Edit Pengguna</h2>
  <form action="simpanEditPengguna.php" method="post">
    <input type="hidden" name="id" value="<?= $data['IDUSER'] ?>">
    <div class="form-group"><label>Nama</label><input type="text" name="nama" value="<?= $data['NAMAUSER'] ?>" required></div>
    <div class="form-group"><label>Username</label><input type="text" name="username" value="<?= $data['USERNAME'] ?>" required></div>
    <div class="form-group"><label>Password</label><input type="text" name="password" value="<?= $data['PASSWORD'] ?>" required></div>
    <div class="form-group">
      <label>Admin</label>
      <select name="idadmin" required>
        <?php while($a = $admin->fetch_assoc()): ?>
          <option value="<?= $a['IDADMIN'] ?>" <?= $a['IDADMIN'] == $data['IDADMIN'] ? 'selected' : '' ?>><?= $a['NAMAADMIN'] ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <button type="submit" class="btn">Update</button>
  </form>
</div>
</body>
</html>
