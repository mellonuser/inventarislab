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
        <script src="function.js"></script>
    </body>