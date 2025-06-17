<?php
session_start();
if (!isset($_SESSION['iduser'])) {
  header("Location: login.php");
  exit();
}
include 'koneksi.php';

$iduser = $_SESSION['iduser'];
$user = $koneksi->query("SELECT * FROM USERS WHERE IDUSER = $iduser")->fetch_assoc();

$riwayat = $koneksi->query("
  SELECT P.IDPINJAM, P.TANGGALPINJAM, 
    (SELECT TANGGALKEMBALI FROM PENGEMBALIAN WHERE IDPINJAM = P.IDPINJAM LIMIT 1) AS TGLKEMBALI,
    (SELECT NAMABARANG FROM BARANG WHERE IDPINJAM = P.IDPINJAM LIMIT 1) AS BARANG
  FROM PEMINJAMAN P
  WHERE P.IDUSER = $iduser
  ORDER BY P.TANGGALPINJAM DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Pengguna</title>
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
        <li class="nav-item">
          <a href="dashboardUser.php" class="nav-link active"><span class="nav-icon">🏠</span> Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="lamanPeminjamanUser.php" class="nav-link"><span class="nav-icon">➕</span> Ajukan Peminjaman</a>
        </li>
        <li class="nav-item">
          <a href="lamanPengembalianUser.php" class="nav-link"><span class="nav-icon">↩️</span> Pengembalian</a>
        </li>
        <li class="nav-item">
          <a href="logout.php" class="nav-link"><span class="nav-icon">🚪</span> Logout</a>
        </li>
      </ul>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="main-content">
    <section class="header">
      <h1>Halo, <?= $user['NAMAUSER'] ?></h1>
      <p>Selamat datang di sistem inventaris laboratorium</p>
    </section>

    <div class="content-section">
      <div class="section-header">
        <h3>Riwayat Peminjaman Saya</h3>
      </div>

      <table class="table">
        <thead>
          <tr>
            <th>ID Pinjam</th>
            <th>Barang</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $riwayat->fetch_assoc()): ?>
          <tr>
            <td><?= $row['IDPINJAM'] ?></td>
            <td><?= $row['BARANG'] ?></td>
            <td><?= $row['TANGGALPINJAM'] ?></td>
            <td><?= $row['TGLKEMBALI'] ?: '-' ?></td>
            <td>
              <?php if ($row['TGLKEMBALI']): ?>
                <span class="status-badge status-available">Dikembalikan</span>
              <?php else: ?>
                <span class="status-badge status-borrowed">Belum Kembali</span>
              <?php endif; ?>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </main>
</div>
</body>
</html>