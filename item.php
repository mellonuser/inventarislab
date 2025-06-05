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
         <script src="function.js"></script>
    </body>
