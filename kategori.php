<?php
include 'koneksi.php';

$kategori = $koneksi->query("
  SELECT 
    K.IDKATEGORI,
    K.NAMAKATEGORI,
    COUNT(B.IDBARANG) AS JUMLAHBARANG
  FROM KATEGORI K
  LEFT JOIN BARANG B ON K.IDKATEGORI = B.IDKATEGORI
  GROUP BY K.IDKATEGORI, K.NAMAKATEGORI
  ORDER BY K.IDKATEGORI
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Kategori Barang - Inventaris Lab</title>
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
        <li class="nav-item"><a href="pengembalian.php" class="nav-link"><span class="nav-icon">↩️</span> Pengembalian</a></li>
        <li class="nav-item"><a href="kategori.php" class="nav-link active"><span class="nav-icon">🏷️</span> Kategori</a></li>
        <li class="nav-item"><a href="pengguna.php" class="nav-link"><span class="nav-icon">👥</span> Pengguna</a></li>
        <li class="nav-item"><a href="logout.php" class="nav-link"><span class="nav-icon">🚪</span> Logout</a></li>
      </ul>
    </nav>
  </aside>

  <main class="main-content">
    <section id="categories" class="section">
      <div class="header">
        <h1>Kategori Barang</h1>
        <p>Manajemen kategori inventaris laboratorium</p>
      </div>

      <div class="content-section">
        <div class="section-header">
          <h3>Daftar Kategori</h3>
          <a href="tambahKategori.php" class="btn">+ Tambah Kategori</a>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
  <?php while($row = $kategori->fetch_assoc()): ?>
    <div class="stat-card">
      <h4><?= $row['NAMAKATEGORI'] ?></h4>
      <p><?= $row['JUMLAHBARANG'] ?> barang</p>
      <div style="margin-top: 10px;">
        <a href="editKategori.php?id=<?= $row['IDKATEGORI'] ?>" class="btn" style="font-size: 12px;">Edit</a>
        <a href="hapusKategori.php?id=<?= $row['IDKATEGORI'] ?>" class="btn" style="font-size: 12px; background-color: #dc3545;" onclick="return confirm('Yakin hapus kategori ini?')">Hapus</a>
      </div>
    </div>
  <?php endwhile; ?>
</div>
      </div>
    </section>
  </main>
</div>
</body>
</html>
