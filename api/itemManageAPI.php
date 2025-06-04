<?php
// api/itemManage.php
require_once '../config/databaseConfig.php';
require_once '../config/cors.php';

class ItemsAPI {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    
    // Get all items with category and status info
    public function getItems($search = '') {
        try {
            $query = "SELECT 
                        b.IDBARANG,
                        b.NAMABARANG,
                        b.JUMLAHBARANG,
                        k.NAMAKATEGORI,
                        u.NAMAUSER,
                        a.NAMAADMIN,
                        CASE 
                            WHEN b.IDPINJAM IS NULL THEN 'Tersedia'
                            ELSE 'Dipinjam'
                        END as status,
                        b.IDPINJAM
                      FROM BARANG b
                      JOIN KATEGORI k ON b.IDKATEGORI = k.IDKATEGORI
                      JOIN USERS u ON b.IDUSER = u.IDUSER
                      JOIN ADMIN a ON b.IDADMIN = a.IDADMIN";
            
            if (!empty($search)) {
                $query .= " WHERE b.NAMABARANG LIKE :search OR k.NAMAKATEGORI LIKE :search";
            }
            
            $query .= " ORDER BY b.IDBARANG DESC";
            
            $stmt = $this->db->prepare($query);
            
            if (!empty($search)) {
                $searchTerm = "%{$search}%";
                $stmt->bindParam(':search', $searchTerm);
            }
            
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            sendResponse([
                'success' => true,
                'data' => $result
            ]);
            
        } catch(Exception $e) {
            sendResponse(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    // Add new item
    public function addItem($data) {
        try {
            $query = "INSERT INTO BARANG (IDUSER, IDKATEGORI, IDADMIN, NAMABARANG, JUMLAHBARANG) 
                      VALUES (:iduser, :idkategori, :idadmin, :namabarang, :jumlahbarang)";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':iduser', $data['iduser']);
            $stmt->bindParam(':idkategori', $data['idkategori']);
            $stmt->bindParam(':idadmin', $data['idadmin']);
            $stmt->bindParam(':namabarang', $data['namabarang']);
            $stmt->bindParam(':jumlahbarang', $data['jumlahbarang']);
            
            if ($stmt->execute()) {
                sendResponse([
                    'success' => true,
                    'message' => 'Barang berhasil ditambahkan',
                    'id' => $this->db->lastInsertId()
                ]);
            } else {
                sendResponse(['success' => false, 'message' => 'Gagal menambahkan barang'], 500);
            }
            
        } catch(Exception $e) {
            sendResponse(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    // Update item
    public function updateItem($id, $data) {
        try {
            $query = "UPDATE BARANG SET 
                        NAMABARANG = :namabarang,
                        JUMLAHBARANG = :jumlahbarang,
                        IDKATEGORI = :idkategori,
                        IDUSER = :iduser
                      WHERE IDBARANG = :id";
            
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':namabarang', $data['namabarang']);
            $stmt->bindParam(':jumlahbarang', $data['jumlahbarang']);
            $stmt->bindParam(':idkategori', $data['idkategori']);
            $stmt->bindParam(':iduser', $data['iduser']);
            
            if ($stmt->execute()) {
                sendResponse([
                    'success' => true,
                    'message' => 'Barang berhasil diupdate'
                ]);
            } else {
                sendResponse(['success' => false, 'message' => 'Gagal mengupdate barang'], 500);
            }
            
        } catch(Exception $e) {
            sendResponse(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    // Delete item
    public function deleteItem($id) {
        try {
            // Check if item is currently borrowed
            $checkQuery = "SELECT IDPINJAM FROM BARANG WHERE IDBARANG = :id";
            $checkStmt = $this->db->prepare($checkQuery);
            $checkStmt->bindParam(':id', $id);
            $checkStmt->execute();
            $result = $checkStmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result && $result['IDPINJAM'] !== null) {
                sendResponse(['success' => false, 'message' => 'Tidak dapat menghapus barang yang sedang dipinjam'], 400);
            }
            
            $query = "DELETE FROM BARANG WHERE IDBARANG = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            
            if ($stmt->execute()) {
                sendResponse([
                    'success' => true,
                    'message' => 'Barang berhasil dihapus'
                ]);
            } else {
                sendResponse(['success' => false, 'message' => 'Gagal menghapus barang'], 500);
            }
            
        } catch(Exception $e) {
            sendResponse(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    // Get categories for dropdown
    public function getCategories() {
        try {
            $query = "SELECT IDKATEGORI, NAMAKATEGORI FROM KATEGORI ORDER BY NAMAKATEGORI";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            sendResponse([
                'success' => true,
                'data' => $result
            ]);
            
        } catch(Exception $e) {
            sendResponse(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    // Get users for dropdown
    public function getUsers() {
        try {
            $query = "SELECT IDUSER, NAMAUSER FROM USERS ORDER BY NAMAUSER";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            sendResponse([
                'success' => true,
                'data' => $result
            ]);
            
        } catch(Exception $e) {
            sendResponse(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}

// Handle API requests
$api = new ItemsAPI();
$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        if (isset($_GET['action'])) {
            switch($_GET['action']) {
                case 'categories':
                    $api->getCategories();
                    break;
                case 'users':
                    $api->getUsers();
                    break;
                default:
                    $search = isset($_GET['search']) ? validateInput($_GET['search']) : '';
                    $api->getItems($search);
            }
        } else {
            $search = isset($_GET['search']) ? validateInput($_GET['search']) : '';
            $api->getItems($search);
        }
        break;
        
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        
        if (!$data) {
            sendResponse(['success' => false, 'message' => 'Invalid JSON data'], 400);
        }
        
        // Validate required fields
        $required = ['namabarang', 'jumlahbarang', 'idkategori', 'iduser', 'idadmin'];
        foreach ($required as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                sendResponse(['success' => false, 'message' => "Field {$field} is required"], 400);
            }
        }
        
        // Sanitize data
        $cleanData = [];
        foreach ($data as $key => $value) {
            $cleanData[$key] = validateInput($value);
        }
        
        $api->addItem($cleanData);
        break;
        
    case 'PUT':
        if (!isset($_GET['id'])) {
            sendResponse(['success' => false, 'message' => 'ID is required'], 400);
        }
        
        $data = json_decode(file_get_contents("php://input"), true);
        
        if (!$data) {
            sendResponse(['success' => false, 'message' => 'Invalid JSON data'], 400);
        }
        
        // Sanitize data
        $cleanData = [];
        foreach ($data as $key => $value) {
            $cleanData[$key] = validateInput($value);
        }
        
        $api->updateItem($_GET['id'], $cleanData);
        break;
        
    case 'DELETE':
        if (!isset($_GET['id'])) {
            sendResponse(['success' => false, 'message' => 'ID is required'], 400);
        }
        
        $api->deleteItem($_GET['id']);
        break;
        
    default:
        sendResponse(['success' => false, 'message' => 'Method not allowed'], 405);
}
?>