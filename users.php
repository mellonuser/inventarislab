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
    </div>
    <script src="function.js"></script>
</body>
             