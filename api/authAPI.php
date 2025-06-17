<?php
session_start();
include '../koneksi.php';

if ($_GET['action'] === 'login') {
    $data = json_decode(file_get_contents('php://input'), true);
    $username = $data['username'];
    $password = $data['password'];

    // Cek di tabel ADMIN dulu
    $admin = $koneksi->query("SELECT * FROM ADMIN WHERE USERNAME = '$username' AND PASSWORD = '$password'");
    if ($admin->num_rows > 0) {
        $row = $admin->fetch_assoc();
        $_SESSION['idadmin'] = $row['IDADMIN'];
        $_SESSION['namaadmin'] = $row['NAMAADMIN'];
        echo json_encode(['success' => true, 'role' => 'admin']);
        exit;
    }

    // Jika bukan admin, cek di tabel USERS
    $user = $koneksi->query("SELECT * FROM USERS WHERE USERNAME = '$username' AND PASSWORD = '$password'");
    if ($user->num_rows > 0) {
        $row = $user->fetch_assoc();
        $_SESSION['iduser'] = $row['IDUSER'];
        $_SESSION['namauser'] = $row['NAMAUSER'];
        echo json_encode(['success' => true, 'role' => 'user']);
        exit;
    }

    // Jika gagal login
    echo json_encode(['success' => false, 'message' => 'Username atau password salah']);
}