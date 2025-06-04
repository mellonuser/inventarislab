<?php
// api/dashboardAPI.php
require_once '../config/databaseConfig.php';
require_once '../config/cors.php';

class DashboardAPI {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    
    public function getStats() {
        try {
            // Total Barang
            $query = "SELECT COUNT(*) as total FROM BARANG";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $totalItems = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            // Barang yang sedang dipinjam (ada IDPINJAM)
            $query = "SELECT COUNT(*) as borrowed FROM BARANG WHERE IDPINJAM IS NOT NULL";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $borrowedItems = $stmt->fetch(PDO::FETCH_ASSOC)['borrowed'];
            
            // Barang tersedia
            $availableItems = $totalItems - $borrowedItems;
            
            // Total Users
            $query = "SELECT COUNT(*) as total FROM USERS";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $totalUsers = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            // Total Kategori
            $query = "SELECT COUNT(*) as total FROM KATEGORI";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $totalCategories = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            sendResponse([
                'success' => true,
                'data' => [
                    'totalItems' => $totalItems,
                    'borrowedItems' => $borrowedItems,
                    'availableItems' => $availableItems,
                    'totalUsers' => $totalUsers,
                    'totalCategories' => $totalCategories
                ]
            ]);
            
        } catch(Exception $e) {
            sendResponse(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    public function getRecentBorrowings() {
        try {
            $query = "SELECT 
                        p.IDPINJAM,
                        p.TANGGALPINJAM,
                        u.NAMAUSER,
                        b.NAMABARANG,
                        CASE 
                            WHEN pg.TANGGALKEMBALI IS NULL THEN 'Dipinjam'
                            ELSE 'Dikembalikan'
                        END as status
                      FROM PEMINJAMAN p
                      JOIN USERS u ON p.IDUSER = u.IDUSER
                      JOIN BARANG b ON b.IDPINJAM = p.IDPINJAM
                      LEFT JOIN PENGEMBALIAN pg ON pg.IDPINJAM = p.IDPINJAM
                      ORDER BY p.TANGGALPINJAM DESC
                      LIMIT 10";
            
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
$api = new DashboardAPI();
$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        if (isset($_GET['action'])) {
            switch($_GET['action']) {
                case 'stats':
                    $api->getStats();
                    break;
                case 'recent':
                    $api->getRecentBorrowings();
                    break;
                default:
                    sendResponse(['success' => false, 'message' => 'Invalid action'], 400);
            }
        } else {
            $api->getStats();
        }
        break;
    default:
        sendResponse(['success' => false, 'message' => 'Method not allowed'], 405);
}
?>