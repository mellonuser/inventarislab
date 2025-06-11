<?php
$currentPage = 'kategori';
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
    <?php
       include 'sidebar.php';
       ?>
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
          <a href="tambahKategori.php" class="btn" onclick="alert('Fungsi Tambah Kategori belum tersedia')">+ Tambah Kategori</a>
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
