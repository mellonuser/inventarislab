<?php
include 'koneksi.php';

$id = $_GET['id'];
$data = $koneksi->query("SELECT * FROM BARANG WHERE IDBARANG = $id")->fetch_assoc();
$kategori = $koneksi->query("SELECT * FROM KATEGORI");
$users = $koneksi->query("SELECT * FROM USERS");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Barang</title>
  <link rel="stylesheet" href="./css/form.css" />
</head>
<body>
  <div class="container" style="padding: 30px;">
    <h2>Edit Barang</h2>
    <form action="simpanEditBarang.php" method="post">
      <input type="hidden" name="idbarang" value="<?= $data['IDBARANG'] ?>">
      <div class="form-group">
        <label>Nama Barang</label>
        <input type="text" name="namabarang" value="<?= $data['NAMABARANG'] ?>" required>
      </div>
      <div class="form-group">
        <label>Kategori</label>
        <select name="idkategori" required>
          <?php while($k = $kategori->fetch_assoc()): ?>
            <option value="<?= $k['IDKATEGORI'] ?>" <?= $k['IDKATEGORI'] == $data['IDKATEGORI'] ? 'selected' : '' ?>>
              <?= $k['NAMAKATEGORI'] ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="form-group">
        <label>Jumlah</label>
        <input type="number" name="jumlahbarang" value="<?= $data['JUMLAHBARANG'] ?>" required>
      </div>
      <button type="submit" class="btn">Update</button>
    </form>
  </div>
</body>
</html>
