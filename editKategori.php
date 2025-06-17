<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = $koneksi->query("SELECT * FROM KATEGORI WHERE IDKATEGORI = $id")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Kategori</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div class="container" style="padding: 30px;">
  <h2>Edit Kategori</h2>
  <form action="simpanEditKategori.php" method="post">
    <input type="hidden" name="id" value="<?= $data['IDKATEGORI'] ?>">
    <div class="form-group">
      <label>Nama Kategori</label>
      <input type="text" name="nama" value="<?= $data['NAMAKATEGORI'] ?>" required>
    </div>
    <button type="submit" class="btn">Update</button>
  </form>
</div>
</body>
</html>
