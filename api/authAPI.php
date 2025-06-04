<?php
// api/authAPI.php
require_once '../config/cors.php';
require_once '../config/databaseConfig.php';
session_start();

class AuthAPI {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    
    public function login($data) {
        try {
            if (empty($data['username']) || empty($data['password'])) {
                sendResponse(['success' => false, 'message' => 'Username dan password harus diisi'], 400);
            }

            $query = "SELECT IDADMIN as id, NAMAADMIN as nama, 'admin' as role, USERNAME, PASSWORD 
                      FROM ADMIN WHERE USERNAME = :username";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $data['username']);
            $stmt->execute();
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($admin && password_verify($data['password'], $admin['PASSWORD'])) {
                $_SESSION['user_id'] = $admin['id'];
                $_SESSION['user_name'] = $admin['nama'];
                $_SESSION['user_role'] = 'admin';
                $_SESSION['username'] = $admin['USERNAME'];
                sendResponse(['success' => true, 'message' => 'Login berhasil', 'user' => [
                    'id' => $admin['id'], 'name' => $admin['nama'], 'role' => 'admin', 'username' => $admin['USERNAME']
                ]]);
                return;
            }

            $query = "SELECT u.IDUSER as id, u.NAMAUSER as nama, 'user' as role, u.USERNAME, u.PASSWORD,
                             a.NAMAADMIN as admin_name
                      FROM USERS u 
                      JOIN ADMIN a ON u.IDADMIN = a.IDADMIN
                      WHERE u.USERNAME = :username";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $data['username']);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($data['password'], $user['PASSWORD'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nama'];
                $_SESSION['user_role'] = 'user';
                $_SESSION['username'] = $user['USERNAME'];
                $_SESSION['admin_name'] = $user['admin_name'];
                sendResponse(['success' => true, 'message' => 'Login berhasil', 'user' => [
                    'id' => $user['id'], 'name' => $user['nama'], 'role' => 'user',
                    'username' => $user['USERNAME'], 'admin_name' => $user['admin_name']
                ]]);
                return;
            }

            sendResponse(['success' => false, 'message' => 'Username atau password salah'], 401);
        } catch (Exception $e) {
            sendResponse(['success' => false, 'message' => 'Terjadi kesalahan sistem'], 500);
        }
    }

    public function register($data) {
        try {
            if (empty($data['username']) || empty($data['password']) || empty($data['nama']) || empty($data['idadmin'])) {
                sendResponse(['success' => false, 'message' => 'Semua field harus diisi'], 400);
            }

            $query = "SELECT USERNAME FROM ADMIN WHERE USERNAME = :username 
                      UNION 
                      SELECT USERNAME FROM USERS WHERE USERNAME = :username";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $data['username']);
            $stmt->execute();

            if ($stmt->fetch()) {
                sendResponse(['success' => false, 'message' => 'Username sudah digunakan'], 409);
            }

            $query = "SELECT IDADMIN FROM ADMIN WHERE IDADMIN = :idadmin";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':idadmin', $data['idadmin']);
            $stmt->execute();

            if (!$stmt->fetch()) {
                sendResponse(['success' => false, 'message' => 'Admin tidak ditemukan'], 404);
            }

            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

            $query = "INSERT INTO USERS (NAMAUSER, USERNAME, PASSWORD, IDADMIN) 
                      VALUES (:nama, :username, :password, :idadmin)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':nama', $data['nama']);
            $stmt->bindParam(':username', $data['username']);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':idadmin', $data['idadmin']);

            if ($stmt->execute()) {
                sendResponse(['success' => true, 'message' => 'Registrasi berhasil']);
            } else {
                sendResponse(['success' => false, 'message' => 'Gagal melakukan registrasi'], 500);
            }
        } catch (Exception $e) {
            sendResponse(['success' => false, 'message' => 'Terjadi kesalahan sistem'], 500);
        }
    }

    public function logout() {
        try {
            session_destroy();
            sendResponse(['success' => true, 'message' => 'Logout berhasil']);
        } catch (Exception $e) {
            sendResponse(['success' => false, 'message' => 'Terjadi kesalahan saat logout'], 500);
        }
    }

    public function checkAuth() {
        try {
            if (isset($_SESSION['user_id'])) {
                sendResponse(['success' => true, 'authenticated' => true, 'user' => [
                    'id' => $_SESSION['user_id'],
                    'name' => $_SESSION['user_name'],
                    'role' => $_SESSION['user_role'],
                    'username' => $_SESSION['username'],
                    'admin_name' => $_SESSION['admin_name'] ?? null
                ]]);
            } else {
                sendResponse(['success' => true, 'authenticated' => false]);
            }
        } catch (Exception $e) {
            sendResponse(['success' => false, 'message' => 'Terjadi kesalahan sistem'], 500);
        }
    }

    public function changePassword($data) {
        try {
            if (!isset($_SESSION['user_id'])) {
                sendResponse(['success' => false, 'message' => 'Silakan login terlebih dahulu'], 401);
            }

            if (empty($data['current_password']) || empty($data['new_password'])) {
                sendResponse(['success' => false, 'message' => 'Password lama dan baru harus diisi'], 400);
            }

            $userId = $_SESSION['user_id'];
            $userRole = $_SESSION['user_role'];

            $query = $userRole === 'admin'
                ? "SELECT PASSWORD FROM ADMIN WHERE IDADMIN = :id"
                : "SELECT PASSWORD FROM USERS WHERE IDUSER = :id";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result || !password_verify($data['current_password'], $result['PASSWORD'])) {
                sendResponse(['success' => false, 'message' => 'Password lama tidak sesuai'], 400);
            }

            $hashedPassword = password_hash($data['new_password'], PASSWORD_DEFAULT);

            $query = $userRole === 'admin'
                ? "UPDATE ADMIN SET PASSWORD = :password WHERE IDADMIN = :id"
                : "UPDATE USERS SET PASSWORD = :password WHERE IDUSER = :id";

            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':id', $userId);

            if ($stmt->execute()) {
                sendResponse(['success' => true, 'message' => 'Password berhasil diubah']);
            } else {
                sendResponse(['success' => false, 'message' => 'Gagal mengubah password'], 500);
            }
        } catch (Exception $e) {
            sendResponse(['success' => false, 'message' => 'Terjadi kesalahan sistem'], 500);
        }
    }
}

// Fungsi utilitas untuk mengirim response JSON
function sendResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

// Handle API request
$auth = new AuthAPI();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $action = $_GET['action'] ?? '';

    switch ($action) {
        case 'login':
            $auth->login($input);
            break;
        case 'register':
            $auth->register($input);
            break;
        case 'change-password':
            $auth->changePassword($input);
            break;
        default:
            sendResponse(['success' => false, 'message' => 'Aksi tidak dikenali'], 400);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? '';

    switch ($action) {
        case 'logout':
            $auth->logout();
            break;
        case 'check-auth':
            $auth->checkAuth();
            break;
        default:
            sendResponse(['success' => false, 'message' => 'Aksi tidak dikenali'], 400);
    }
} else {
    sendResponse(['success' => false, 'message' => 'Metode tidak didukung'], 405);
}
