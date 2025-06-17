<?php
include 'koneksi.php';

$pengembalian = $koneksi->query("
  SELECT 
    P.IDPINJAM,
    U.NAMAUSER,
    P.TANGGALPINJAM,
    (
      SELECT TANGGALKEMBALI 
      FROM PENGEMBALIAN 
      WHERE IDPINJAM = P.IDPINJAM 
      ORDER BY IDKEMBALI DESC 
      LIMIT 1
    ) AS TANGGALKEMBALI
  FROM PEMINJAMAN P
  JOIN USERS U ON P.IDUSER = U.IDUSER
  ORDER BY P.TANGGALPINJAM DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Riwayat Peminjaman - Inventaris Lab</title>
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
        <li class="nav-item"><a href="dashboard.php" class="nav-link"><span class="nav-icon">📊</span> Dashboard</a></li>
        <li class="nav-item"><a href="daftarBarang.php" class="nav-link"><span class="nav-icon">📦</span> Daftar Barang</a></li>
        <li class="nav-item"><a href="peminjaman.php" class="nav-link"><span class="nav-icon">📋</span> Peminjaman</a></li>
        <li class="nav-item"><a href="pengembalian.php" class="nav-link active"><span class="nav-icon">↩️</span> Pengembalian</a></li>
        <li class="nav-item"><a href="kategori.php" class="nav-link"><span class="nav-icon">🏷️</span> Kategori</a></li>
        <li class="nav-item"><a href="pengguna.php" class="nav-link"><span class="nav-icon">👥</span> Pengguna</a></li>
        <li class="nav-item"><a href="logout.php" class="nav-link"><span class="nav-icon">🚪</span> Logout</a></li>
      </ul>
    </nav>
  </aside>

  <main class="main-content">
    <section id="returns" class="section">
      <div class="header">
        <h1>Riwayat Peminjaman</h1>
        <p>Menampilkan semua riwayat peminjaman berdasarkan data utama</p>
      </div>

      <div class="content-section">
        <h3>Riwayat Peminjaman</h3>
        <table class="table">
          <thead>
            <tr>
              <th>ID Pinjam</th>
              <th>Nama Peminjam</th>
              <th>Tgl Pinjam</th>
              <th>Tgl Kembali</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $pengembalian->fetch_assoc()): ?>
              <tr>
                <td><?= $row['IDPINJAM'] ?></td>
                <td><?= $row['NAMAUSER'] ?></td>
                <td><?= $row['TANGGALPINJAM'] ?></td>
                <td><?= $row['TANGGALKEMBALI'] ?: '-' ?></td>
                <td>
                  <?php if ($row['TANGGALKEMBALI']) : ?>
                    <span class="status-badge status-available">Dikembalikan</span>
                  <?php else : ?>
                    <span class="status-badge status-borrowed">Belum Kembali</span>
                  <?php endif; ?>
                </td>
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
