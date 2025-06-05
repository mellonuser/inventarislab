<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Sistem Inventaris Lab</title>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <?php include 'sidebar.php'; ?>
        </aside>
        
        <main class="main-content">
            <!-- Dashboard Section -->
            <section id="dashboard" class="section">
                <div class="header">
                    <h1>Dashboard Sistem Inventaris Lab</h1>
                    <p>Selamat datang di sistem manajemen inventaris laboratorium</p>
                </div>
                
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-number" id="total-items">20</div>
                        <div class="stat-label">Total Barang</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" id="borrowed-items">18</div>
                        <div class="stat-label">Sedang Dipinjam</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" id="available-items">2</div>
                        <div class="stat-label">Tersedia</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" id="total-users">15</div>
                        <div class="stat-label">Total Pengguna</div>
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
                        <tbody id="recent-borrowings">
                            <tr>
                                <td>2025-04-12</td>
                                <td>Eko Santoso</td>
                                <td>Software Antivirus Lisensi</td>
                                <td><span class="status-badge status-borrowed">Dipinjam</span></td>
                            </tr>
                            <tr>
                                <td>2025-04-10</td>
                                <td>Doni Setiawan</td>
                                <td>Baterai Alkaline</td>
                                <td><span class="status-badge status-borrowed">Dipinjam</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
    
    <!-- Modals -->
    <div id="addItemModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Tambah Barang Baru</h2>
            <form>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" required>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select required>
                        <option value="">Pilih Kategori</option>
                        <option value="1">Komputer & Laptop</option>
                        <option value="2">Perangkat Jaringan</option>
                        <option value="3">Perangkat Penyimpanan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" required min="1">
                </div>
                <div class="form-group">
                    <label>User ID</label>
                    <select required>
                        <option value="">Pilih User</option>
                        <option value="1">Hibban Ramadhan</option>
                        <option value="2">Salsa Putri</option>
                    </select>
                </div>
                <button type="submit" class="btn">Simpan Barang</button>
            </form>
        </div>
    </div>
    <script src="function.js"></script>
</body>
</html>