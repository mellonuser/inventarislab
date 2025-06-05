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
        <script src="function.js"></script>
    </body>