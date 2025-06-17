<?php
session_start();
if (!isset($_SESSION['iduser'])) {
  header("Location: login.php");
  exit();
}
include 'koneksi.php';
$iduser = $_SESSION['iduser'];

$belumKembali = $koneksi->query("
  SELECT P.IDPINJAM, P.TANGGALPINJAM, B.NAMABARANG
  FROM PEMINJAMAN P
  JOIN BARANG B ON B.IDPINJAM = P.IDPINJAM
  WHERE P.IDUSER = $iduser AND NOT EXISTS (
    SELECT 1 FROM PENGEMBALIAN K WHERE K.IDPINJAM = P.IDPINJAM
  )
");
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
        <li class="nav-item"><a href="lamanPeminjamanUser.php" class="nav-link"><span class="nav-icon">➕</span> Peminjaman</a></li>
        <li class="nav-item"><a href="lamanPengembalianUser.php" class="nav-link active"><span class="nav-icon">↩️</span> Pengembalian</a></li>
        <li class="nav-item"><a href="logout.php" class="nav-link"><span class="nav-icon">🚪</span> Logout</a></li>
      </ul>
    </nav>
  </aside>

  <main class="main-content">
    <section class="header">
      <h1>Pengembalian Barang</h1>
      <p>Barang yang sedang Anda pinjam</p>
    </section>

    <div class="content-section">
      <table class="table">
        <thead>
          <tr>
            <th>ID Pinjam</th>
            <th>Nama Barang</th>
            <th>Tanggal Pinjam</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $belumKembali->fetch_assoc()): ?>
          <tr>
            <td><?= $row['IDPINJAM'] ?></td>
            <td><?= $row['NAMABARANG'] ?></td>
            <td><?= $row['TANGGALPINJAM'] ?></td>
            <td>
              <a href="proses-kembalikan-user.php?id=<?= $row['IDPINJAM'] ?>" class="btn" onclick="return confirm('Yakin kembalikan barang ini?')">Kembalikan</a>
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