<?php
// api/borrowReturnsAPI.php
require_once '../config/databaseConfig.php';
require_once '../config/cors.php';

class BorrowingAPI {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    
    // Get all borrowings with user and item info
    public function getBorrowings() {
        try {
            $query = "SELECT 
                        p.IDPINJAM,
                        p.TANGGALPINJAM,
                        u.NAMAUSER,
                        b.NAMABARANG,
                        b.IDBARANG,
                        pg.TANGGALKEMBALI,
                        CASE 
                            WHEN pg.TANGGALKEMBALI IS NULL THEN 'Belum Kembali'
                            ELSE 'Sudah Kembali'
                        END as status
                      FROM PEMINJAMAN p
                      JOIN USERS u ON p.IDUSER = u.IDUSER
                      LEFT JOIN BARANG b ON b.IDPINJAM = p.IDPINJAM
                      LEFT JOIN PENGEMBALIAN pg ON pg.IDPINJAM = p.IDPINJAM
                      ORDER BY p.TANGGALPINJAM DESC";
            
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
    
    // Create new borrowing
    public function createBorrowing($data) {
        try {
            $this->db->beginTransaction();
            
            // 1. Insert into PEMINJAMAN table
            $query = "INSERT INTO PEMINJAMAN (IDUSER, TANGGALPINJAM) VALUES (:iduser, :tanggalpinjam)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':iduser', $data['iduser']);
            $stmt->bindParam(':tanggalpinjam', $data['tanggalpinjam']);
            $stmt->execute();
            
            $idPinjam = $this->db->lastInsertId();
            
            // 2. Update BARANG table to link with borrowing
            $updateQuery = "UPDATE BARANG SET IDPINJAM = :idpinjam WHERE IDBARANG = :idbarang";
            $updateStmt = $this->db->prepare($updateQuery);
            $updateStmt->bindParam(':idpinjam', $idPinjam);
            $updateStmt->bindParam(':idbarang', $data['idbarang']);
            $updateStmt->execute();
            
            $this->db->commit();
            
            sendResponse([
                'success' => true,
                'message' => 'Peminjaman berhasil dicatat',
                'id' => $idPinjam
            ]);
            
        } catch(Exception $e) {
            $this->db->rollback();
            sendResponse(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    // Process return
    public function processReturn($idPinjam) {
        try {
            $this->db->beginTransaction();
            
            // 1. Check if borrowing exists and not returned yet
            $checkQuery = "SELECT p.IDPINJAM, pg.IDKEMBALI 
                          FROM PEMINJAMAN p 
                          LEFT JOIN PENGEMBALIAN pg ON p.IDPINJAM = pg.IDPINJAM 
                          WHERE p.IDPINJAM = :idpinjam";
            $checkStmt = $this->db->prepare($checkQuery);
            $checkStmt->bindParam(':idpinjam', $idPinjam);
            $checkStmt->execute();
            $result = $checkStmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$result) {
                sendResponse(['success' => false, 'message' => 'Peminjaman tidak ditemukan'], 404);
            }
            
            if ($result['IDKEMBALI']) {
                sendResponse(['success' => false, 'message' => 'Barang sudah dikembalikan'], 400);
            }
            
            // 2. Insert return record
            $returnQuery = "INSERT INTO PENGEMBALIAN (IDPINJAM, TANGGALKEMBALI) VALUES (:idpinjam, NOW())";
            $returnStmt = $this->db->prepare($returnQuery);
            $returnStmt->bindParam(':idpinjam', $idPinjam);
            $returnStmt->execute();
            
            // 3. Update BARANG to remove borrowing link
            $updateQuery = "UPDATE BARANG SET IDPINJAM = NULL WHERE IDPINJAM = :idpinjam";
            $updateStmt = $this->db->prepare($updateQuery);
            $updateStmt->bindParam(':idpinjam', $idPinjam);
            $updateStmt->execute();
            
            $this->db->commit();
            
            sendResponse([
                'success' => true,
                'message' => 'Pengembalian berhasil diproses'
            ]);
            
        } catch(Exception $e) {
            $this->db->rollback();
            sendResponse(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    // Get available items for borrowing
    public function getAvailableItems() {
        try {
            $query = "SELECT 
                        b.IDBARANG,
                        b.NAMABARANG,
                        b.JUMLAHBARANG,
                        k.NAMAKATEGORI
                      FROM BARANG b
                      JOIN KATEGORI k ON b.IDKATEGORI = k.IDKATEGORI
                      WHERE b.IDPINJAM IS NULL
                      ORDER BY b.NAMABARANG";
            
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
    
    // Get returns history
    public function getReturns() {
        try {
            $query = "SELECT 
                        pg.IDKEMBALI,
                        pg.IDPINJAM,
                        pg.TANGGALKEMBALI,
                        u.NAMAUSER,
                        b.NAMABARANG,
                        p.TANGGALPINJAM,
                        DATEDIFF(pg.TANGGALKEMBALI, p.TANGGALPINJAM) as durasi_hari
                      FROM PENGEMBALIAN pg
                      JOIN PEMINJAMAN p ON pg.IDPINJAM = p.IDPINJAM
                      JOIN USERS u ON p.IDUSER = u.IDUSER
                      LEFT JOIN BARANG b ON b.IDPINJAM = p.IDPINJAM
                      ORDER BY pg.TANGGALKEMBALI DESC";
            
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
$api = new BorrowingAPI();
$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        if (isset($_GET['action'])) {
            switch($_GET['action']) {
                case 'available-items':
                    $api->getAvailableItems();
                    break;
                case 'users':
                    $api->getUsers();
                    break;
                case 'returns':
                    $api->getReturns();
                    break;
                default:
                    $api->getBorrowings();
            }
        } else {
            $api->getBorrowings();
        }
        break;
        
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        
        if (!$data) {
            sendResponse(['success' => false, 'message' => 'Invalid JSON data'], 400);
        }
        
        if (isset($_GET['action']) && $_GET['action'] === 'return') {
            // Process return
            if (!isset($data['idpinjam'])) {
                sendResponse(['success' => false, 'message' => 'ID Pinjam is required'], 400);
            }
            $api->processReturn($data['idpinjam']);
        } else {
            // Create borrowing
            $required = ['iduser', 'idbarang', 'tanggalpinjam'];
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
            
            $api->createBorrowing($cleanData);
        }
        break;
        
    default:
        sendResponse(['success' => false, 'message' => 'Method not allowed'], 405);
}
?>