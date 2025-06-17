<?php
include 'koneksi.php';

$query = $koneksi->query("
  SELECT 
    B.IDBARANG, 
    B.NAMABARANG, 
    K.NAMAKATEGORI, 
    B.JUMLAHBARANG, 
    B.IDPINJAM
  FROM BARANG B
  JOIN KATEGORI K ON B.IDKATEGORI = K.IDKATEGORI
  ORDER BY B.IDBARANG DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar Barang - Inventaris Lab</title>
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
        <li class="nav-item"><a href="daftarBarang.php" class="nav-link active"><span class="nav-icon">📦</span> Daftar Barang</a></li>
        <li class="nav-item"><a href="peminjaman.php" class="nav-link"><span class="nav-icon">📋</span> Peminjaman</a></li>
        <li class="nav-item"><a href="pengembalian.php" class="nav-link"><span class="nav-icon">↩️</span> Pengembalian</a></li>
        <li class="nav-item"><a href="kategori.php" class="nav-link"><span class="nav-icon">🏷️</span> Kategori</a></li>
        <li class="nav-item"><a href="pengguna.php" class="nav-link"><span class="nav-icon">👥</span> Pengguna</a></li>
        <li class="nav-item"><a href="logout.php" class="nav-link"><span class="nav-icon">🚪</span> Logout</a></li>
      </ul>
    </nav>
  </aside>

  <main class="main-content">
    <section id="items" class="section">
      <div class="header">
        <h1>Daftar Barang</h1>
        <p>Kelola inventaris barang laboratorium</p>
      </div>

      <div class="content-section">
        <div class="section-header">
          <h3>Manajemen Barang</h3>
          <a href="tambahBarang.php" class="btn">+ Tambah Barang</a>
        </div>

        <input type="text" class="search-bar" placeholder="🔍 Cari barang..." id="search-items" />

        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama Barang</th>
              <th>Kategori</th>
              <th>Jumlah</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="items-table">
            <?php while ($row = $query->fetch_assoc()): ?>
              <tr>
                <td><?= $row['IDBARANG'] ?></td>
                <td><?= $row['NAMABARANG'] ?></td>
                <td><?= $row['NAMAKATEGORI'] ?></td>
                <td><?= $row['JUMLAHBARANG'] ?></td>
                <td>
                  <?php if ($row['IDPINJAM']) : ?>
                    <span class="status-badge status-borrowed">Dipinjam</span>
                  <?php else : ?>
                    <span class="status-badge status-available">Tersedia</span>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="editBarang.php?id=<?= $row['IDBARANG'] ?>" class="btn" style="padding:5px 10px; font-size:12px;">Edit</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-items');
    if (searchInput) {
      searchInput.addEventListener('input', function () {
        const searchTerm = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('#items-table tr');
        tableRows.forEach((row) => {
          const text = row.textContent.toLowerCase();
          row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
      });
    }
  });
</script>
</body>
</html>
