<?php
session_start();
if (!isset($_SESSION['iduser'])) {
  header("Location: login.php");
  exit();
}
include 'koneksi.php';

$iduser = $_SESSION['iduser'];
$barang = $koneksi->query("SELECT * FROM BARANG WHERE IDPINJAM IS NULL");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Form Peminjaman</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
  <main class="main-content" style="margin:auto; max-width: 600px; padding: 40px;">
    <section class="content-section">
      <h2>Ajukan Peminjaman Barang</h2>
      <form action="simpanPinjamUser.php" method="post">
        <div class="form-group">
          <label>Pilih Barang</label>
          <select name="idbarang" required>
            <option value="">-- Pilih Barang --</option>
            <?php while ($b = $barang->fetch_assoc()): ?>
              <option value="<?= $b['IDBARANG'] ?>"><?= $b['NAMABARANG'] ?> (Stok: <?= $b['JUMLAHBARANG'] ?>)</option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Tanggal Pinjam</label>
          <input type="datetime-local" name="tanggalpinjam" required>
        </div>
        <button type="submit" class="btn">Ajukan</button>
      </form>
    </section>
  </main>
</div>
</body>
</html>