<?php
include 'koneksi.php';

$users = $koneksi->query("
  SELECT U.IDUSER, U.NAMAUSER, U.USERNAME, A.NAMAADMIN
  FROM USERS U
  JOIN ADMIN A ON U.IDADMIN = A.IDADMIN
  ORDER BY U.IDUSER
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pengguna - Inventaris Lab</title>
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
        <li class="nav-item"><a href="kategori.php" class="nav-link"><span class="nav-icon">🏷️</span> Kategori</a></li>
        <li class="nav-item"><a href="pengguna.php" class="nav-link active"><span class="nav-icon">👥</span> Pengguna</a></li>
        <li class="nav-item"><a href="logout.php" class="nav-link"><span class="nav-icon">🚪</span> Logout</a></li>
      </ul>
    </nav>
  </aside>

  <main class="main-content">
    <section id="returns" class="section">
      <div class="header">
        <h1>Manajemen Pengguna</h1>
        <p>Kelola data pengguna sistem</p>
      </div>

      <div class="content-section">
        <div class="section-header">
          <h3>Daftar Pengguna</h3>
          <a href="tambahPengguna.php" class="btn">+ Tambah Pengguna</a>
        </div>

        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Admin</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $users->fetch_assoc()): ?>
              <tr>
                <td><?= $row['IDUSER'] ?></td>
                <td><?= $row['NAMAUSER'] ?></td>
                <td><?= $row['USERNAME'] ?></td>
                <td><?= $row['NAMAADMIN'] ?></td>
                <td>
                  <a href="editPengguna.php?id=<?= $row['IDUSER'] ?>" class="btn" style="font-size: 12px;">Edit</a>
                  <a href="hapusPengguna.php?id=<?= $row['IDUSER'] ?>" class="btn" style="font-size: 12px; background-color: #dc3545;" onclick="return confirm('Yakin hapus pengguna ini?')">Hapus</a>
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
