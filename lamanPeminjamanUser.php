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
  <meta charset="UTF-8">
  <title>Peminjaman - Pengguna</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div class="container">
  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="logo">
      <div style="font-size: 2em;">🖥️</div>
      <h2>Inventaris Lab-Kom</h2>
    </div>
    <nav>
      <ul class="nav-menu">
        <li class="nav-item"><a href="dashboardUser.php" class="nav-link"><span class="nav-icon">🏠</span> Dashboard</a></li>
        <li class="nav-item"><a href="lamanPeminjamanUser.php" class="nav-link active"><span class="nav-icon">➕</span> Peminjaman</a></li>
        <li class="nav-item"><a href="lamanPengembalianUser.php" class="nav-link"><span class="nav-icon">↩️</span> Pengembalian</a></li>
        <li class="nav-item"><a href="logout.php" class="nav-link"><span class="nav-icon">🚪</span> Logout</a></li>
      </ul>
    </nav>
  </aside>

  <!-- Content -->
  <main class="main-content">
    <section class="header">
      <h1>Ajukan Peminjaman</h1>
      <p>Pilih barang yang tersedia dan ajukan peminjaman</p>
    </section>

    <div class="content-section">
      <form action="ajukanPeminjamanUser.php" method="post">
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
    </div>
  </main>
</div>
</body>
</html>