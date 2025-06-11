<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard - Inventaris Lab</title>
  <link rel="stylesheet" href="./css/style.css" />
</head>
    <div class="logo">
     <a href="dashboard.php">
      <img src="assets/logo.jpeg" alt="logo" width="100" height"auto">
     </a>
      <h2>Inventaris Lab Komputer</h2>
    </div>
    <nav>
      <ul class="nav-menu">
        <li class="nav-item"><a href="dashboard.php" class="nav-link <?php echo ($currentPage == 'dashboard') ? 'active' : ''; ?>"><span class="nav-icon">📊</span> Dashboard</a></li>
        <li class="nav-item"><a href="daftarBarang.php" class="nav-link <?php echo ($currentPage == 'daftarBarang') ? 'active' : ''; ?>"><span class="nav-icon">📦</span> Daftar Barang</a></li>
        <li class="nav-item"><a href="peminjaman.php" class="nav-link <?php echo ($currentPage == 'peminjaman') ? 'active' : ''; ?>"><span class="nav-icon">📋</span> Peminjaman</a></li>
        <li class="nav-item"><a href="pengembalian.php" class="nav-link <?php echo ($currentPage == 'pengembalian') ? 'active' : ''; ?>"><span class="nav-icon">↩️</span> Pengembalian</a></li>
        <li class="nav-item"><a href="kategori.php" class="nav-link <?php echo ($currentPage == 'kategori') ? 'active' : ''; ?>"><span class="nav-icon">🏷️</span> Kategori</a></li>
        <li class="nav-item"><a href="pengguna.php" class="nav-link <?php echo ($currentPage == 'pengguna') ? 'active' : ''; ?>"><span class="nav-icon">👥</span> Pengguna</a></li>
        <li class="nav-item"><a href="logout.php" class="nav-link <?php echo ($currentPage == 'logout') ? 'active' : ''; ?>"><span class="nav-icon">🚪</span> Logout</a></li>
      </ul>
    </nav>
</html>
