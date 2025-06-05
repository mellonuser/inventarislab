<DOCTYPE html>
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
         <script src="function.js"></script>
    </body>