<?php
include 'koneksi.php';

$peminjaman = $koneksi->query("
  SELECT P.IDPINJAM, U.NAMAUSER, B.NAMABARANG, P.TANGGALPINJAM
  FROM PEMINJAMAN P
  JOIN USERS U ON P.IDUSER = U.IDUSER
  JOIN BARANG B ON P.IDPINJAM = B.IDPINJAM
  ORDER BY P.TANGGALPINJAM DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Peminjaman - Inventaris Lab</title>
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
        <li class="nav-item"><a href="peminjaman.php" class="nav-link active"><span class="nav-icon">📋</span> Peminjaman</a></li>
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
        <h1>Peminjaman Barang</h1>
        <p>Kelola peminjaman barang laboratorium</p>
      </div>

      <div class="content-section">
        <div class="section-header">
          <h3>Daftar Peminjaman</h3>
          <a href="tambahPinjam.php" class="btn">+ Peminjaman Baru</a>
        </div>

        <table class="table">
          <thead>
            <tr>
              <th>ID Pinjam</th>
              <th>Peminjam</th>
              <th>Barang</th>
              <th>Tanggal Pinjam</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $peminjaman->fetch_assoc()): ?>
              <tr>
                <td><?= $row['IDPINJAM'] ?></td>
                <td><?= $row['NAMAUSER'] ?></td>
                <td><?= $row['NAMABARANG'] ?></td>
                <td><?= $row['TANGGALPINJAM'] ?></td>
                <td><span class="status-badge status-borrowed">Belum Kembali</span></td>
                <td>
                  <a href="kembalikan.php?id=<?= $row['IDPINJAM'] ?>" onclick="return confirm('Yakin ingin mengembalikan?')" class="btn" style="padding:5px 10px; font-size:12px;">Kembalikan</a>
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
