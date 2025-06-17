<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('koneksi.php');

session_start();
if (!isset($_SESSION['idadmin'])) {
  header('Location: login.php');
  exit;
}

// Ambil statistik
$totalBarangQuery = $koneksi->query("SELECT COUNT(*) AS total FROM BARANG");
$dipinjamQuery = $koneksi->query("SELECT COUNT(*) AS total FROM BARANG WHERE IDPINJAM IS NOT NULL");
$tersediaQuery = $koneksi->query("SELECT COUNT(*) AS total FROM BARANG WHERE IDPINJAM IS NULL");
$totalUserQuery = $koneksi->query("SELECT COUNT(*) AS total FROM USERS");

$totalBarang = $totalBarangQuery->fetch_assoc()['total'];
$dipinjam = $dipinjamQuery->fetch_assoc()['total'];
$tersedia = $tersediaQuery->fetch_assoc()['total'];
$totalUser = $totalUserQuery->fetch_assoc()['total'];

// Ambil peminjaman terbaru (5 terakhir)
$peminjamanQuery = $koneksi->query("
  SELECT P.TANGGALPINJAM, U.NAMAUSER, B.NAMABARANG
  FROM PEMINJAMAN P
  JOIN USERS U ON P.IDUSER = U.IDUSER
  JOIN BARANG B ON P.IDPINJAM = B.IDPINJAM
  ORDER BY P.TANGGALPINJAM DESC
  LIMIT 5
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard - Inventaris Lab</title>
  <link rel="stylesheet" href="./css/style.css" />
</head>
<body>
<div class="container">
  <aside class="sidebar">
    <div class="logo">
      <div style="font-size: 2em;">🖥️</div>
      <h2>Inventaris Lab-Kom</h2>
    </div>
    <nav>
      <ul class="nav-menu">
        <li class="nav-item"><a href="dashboard.php" class="nav-link active"><span class="nav-icon">📊</span> Dashboard</a></li>
        <li class="nav-item"><a href="daftarBarang.php" class="nav-link"><span class="nav-icon">📦</span> Daftar Barang</a></li>
        <li class="nav-item"><a href="peminjaman.php" class="nav-link"><span class="nav-icon">📋</span> Peminjaman</a></li>
        <li class="nav-item"><a href="pengembalian.php" class="nav-link"><span class="nav-icon">↩️</span> Pengembalian</a></li>
        <li class="nav-item"><a href="kategori.php" class="nav-link"><span class="nav-icon">🏷️</span> Kategori</a></li>
        <li class="nav-item"><a href="pengguna.php" class="nav-link"><span class="nav-icon">👥</span> Pengguna</a></li>
        <li class="nav-item"><a href="logout.php" class="nav-link"><span class="nav-icon">🚪</span> Logout</a></li>
      </ul>
    </nav>
  </aside>

  <main class="main-content">
    <section class="section">
      <div class="header">
        <h1>Dashboard Sistem Inventaris Lab</h1>
        <p>Selamat datang di sistem manajemen inventaris laboratorium</p>
      </div>

      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-number"><?= $totalBarang ?></div>
          <div class="stat-label">Total Barang</div>
        </div>
        <div class="stat-card">
          <div class="stat-number"><?= $dipinjam ?></div>
          <div class="stat-label">Sedang Dipinjam</div>
        </div>
        <div class="stat-card">
          <div class="stat-number"><?= $tersedia ?></div>
          <div class="stat-label">Tersedia</div>
        </div>
        <div class="stat-card">
          <div class="stat-number"><?= $totalUser ?></div>
          <div class="stat-label">Total Pengguna</div>
        </div>
      </div>

      <div class="content-section">
  <h3>Unduh Laporan</h3>
  <div style="margin-top: 15px;">
    <a href="laporanPeminjaman.php" class="btn">📄 Download Peminjaman</a>
    <a href="laporanPengembalian.php" class="btn">📄 Download Pengembalian</a>
  </div>
</div>

      <div class="content-section">
        <h3>Peminjaman Terbaru</h3>
        <table class="table">
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Peminjam</th>
              <th>Barang</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $peminjamanQuery->fetch_assoc()): ?>
              <tr>
                <td><?= $row['TANGGALPINJAM'] ?></td>
                <td><?= $row['NAMAUSER'] ?></td>
                <td><?= $row['NAMABARANG'] ?></td>
                <td><span class="status-badge status-borrowed">Dipinjam</span></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>
</div>
</body>
</html>
