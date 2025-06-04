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
            
            <!-- Items Section -->
            <section id="items" class="section hidden">
                <div class="header">
                    <h1>Daftar Barang</h1>
                    <p>Kelola inventaris barang laboratorium</p>
                </div>
                
                <div class="content-section">
                    <div class="section-header">
                        <h3>Manajemen Barang</h3>
                        <button class="btn" onclick="openModal('addItemModal')">+ Tambah Barang</button>
                    </div>
                    
                    <input type="text" class="search-bar" placeholder="🔍 Cari barang..." id="search-items">
                    
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
                            <tr>
                                <td>101</td>
                                <td>Laptop Lenovo ThinkPad</td>
                                <td>Komputer & Laptop</td>
                                <td>5</td>
                                <td><span class="status-badge status-borrowed">Dipinjam</span></td>
                                <td>
                                    <button class="btn" style="padding: 5px 10px; font-size: 12px;">Edit</button>
                                </td>
                            </tr>
                            <tr>
                                <td>106</td>
                                <td>Proyektor Epson</td>
                                <td>Perangkat Output</td>
                                <td>2</td>
                                <td><span class="status-badge status-available">Tersedia</span></td>
                                <td>
                                    <button class="btn" style="padding: 5px 10px; font-size: 12px;">Edit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            
            <!-- Borrowing Section -->
            <section id="borrowing" class="section hidden">
                <div class="header">
                    <h1>Peminjaman Barang</h1>
                    <p>Kelola peminjaman barang laboratorium</p>
                </div>
                
                <div class="content-section">
                    <div class="section-header">
                        <h3>Daftar Peminjaman</h3>
                        <button class="btn" onclick="openModal('addBorrowModal')">+ Peminjaman Baru</button>
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
                            <tr>
                                <td>20</td>
                                <td>Eko Santoso</td>
                                <td>Software Antivirus Lisensi</td>
                                <td>2025-04-12 10:45</td>
                                <td><span class="status-badge status-borrowed">Belum Kembali</span></td>
                                <td>
                                    <button class="btn" style="padding: 5px 10px; font-size: 12px;">Kembalikan</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            
            <!-- Returns Section -->
            <section id="returns" class="section hidden">
                <div class="header">
                    <h1>Pengembalian Barang</h1>
                    <p>Riwayat pengembalian barang</p>
                </div>
                
                <div class="content-section">
                    <h3>Riwayat Pengembalian</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID Kembali</th>
                                <th>ID Pinjam</th>
                                <th>Peminjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>29</td>
                                <td>14</td>
                                <td>Wawan Kurniawan</td>
                                <td>2025-03-20 16:30</td>
                                <td><span class="status-badge status-available">Dikembalikan</span></td>
                            </tr>
                            <tr>
                                <td>30</td>
                                <td>15</td>
                                <td>Dewi Anggraini</td>
                                <td>-</td>
                                <td><span class="status-badge status-borrowed">Belum Kembali</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            
            <!-- Categories Section -->
            <section id="categories" class="section hidden">
                <div class="header">
                    <h1>Kategori Barang</h1>
                    <p>Manajemen kategori inventaris</p>
                </div>
                
                <div class="content-section">
                    <div class="section-header">
                        <h3>Daftar Kategori</h3>
                        <button class="btn" onclick="openModal('addCategoryModal')">+ Tambah Kategori</button>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
                        <div class="stat-card">
                            <h4>Komputer & Laptop</h4>
                            <p style="color: #666; margin-top: 10px;">3 barang</p>
                        </div>
                        <div class="stat-card">
                            <h4>Perangkat Output</h4>
                            <p style="color: #666; margin-top: 10px;">2 barang</p>
                        </div>
                        <div class="stat-card">
                            <h4>Perangkat Input</h4>
                            <p style="color: #666; margin-top: 10px;">2 barang</p>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Users Section -->
            <section id="users" class="section hidden">
                <div class="header">
                    <h1>Manajemen Pengguna</h1>
                    <p>Kelola pengguna sistem</p>
                </div>
                
                <div class="content-section">
                    <div class="section-header">
                        <h3>Daftar Pengguna</h3>
                        <button class="btn" onclick="openModal('addUserModal')">+ Tambah Pengguna</button>
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
                            <tr>
                                <td>1</td>
                                <td>Hibban Ramadhan</td>
                                <td>hibbanr</td>
                                <td>Arif Nugroho</td>
                                <td>
                                    <button class="btn" style="padding: 5px 10px; font-size: 12px;">Edit</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Salsa Putri</td>
                                <td>salsap</td>
                                <td>Budi Santoso</td>
                                <td>
                                    <button class="btn" style="padding: 5px 10px; font-size: 12px;">Edit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
    
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
    
    <div id="addBorrowModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Peminjaman Baru</h2>
            <form>
                <div class="form-group">
                    <label>Peminjam</label>
                    <select required>
                        <option value="">Pilih Peminjam</option>
                        <option value="1">Hibban Ramadhan</option>
                        <option value="2">Salsa Putri</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Barang</label>
                    <select required>
                        <option value="">Pilih Barang</option>
                        <option value="101">Laptop Lenovo ThinkPad</option>
                        <option value="106">Proyektor Epson</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tanggal Pinjam</label>
                    <input type="datetime-local" required>
                </div>
                <button type="submit" class="btn">Catat Peminjaman</button>
            </form>
        </div>
    </div>
    
    <div id="addCategoryModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Tambah Kategori</h2>
            <form>
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" required>
                </div>
                <button type="submit" class="btn">Simpan Kategori</button>
            </form>
        </div>
    </div>
    
    <div id="addUserModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Tambah Pengguna</h2>
            <form>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" required>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" required>
                </div>
                <div class="form-group">
                    <label>Admin</label>
                    <select required>
                        <option value="">Pilih Admin</option>
                        <option value="1">Arif Nugroho</option>
                        <option value="2">Budi Santoso</option>
                        <option value="3">Joko Widodo</option>
                    </select>
                </div>
                <button type="submit" class="btn">Simpan Pengguna</button>
            </form>
        </div>
    </div>
    
    <script src="function.js"></script>

    
</body>
</html>