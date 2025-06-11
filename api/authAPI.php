<?php
require_once '../config/cors.php';
require_once '../config/databaseConfig.php';
require_once '../models/admin.php';
require_once '../models/user.php';

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["message" => "Method not allowed"]);
    exit();
}

$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input['username']) || !isset($input['password'])) {
    http_response_code(400);
    echo json_encode(["message" => "Username and password are required"]);
    exit();
}

$username = $input['username'];
$password = $input['password'];

$db = new Database();
$conn = $db->getConnection();

$adminModel = new Admin($conn);
$userModel = new User($conn);

$admin = $adminModel->getByUsername($username);
if ($admin && $password === $admin['PASSWORD']) {
    echo json_encode([
        "success" => true,
        "role" => "admin",
        "data" => [
            "id" => $admin['IDADMIN'],
            "name" => $admin['NAMAADMIN'],
            "username" => $admin['USERNAME']
        ]
    ]);
    exit();
}

$user = $userModel->getByUsername($username);
if ($user && $password === $user['PASSWORD']) {
    echo json_encode([
        "success" => true,
        "role" => "user",
        "data" => [
            "id" => $user['IDUSER'],
            "name" => $user['NAMAUSER'],
            "username" => $user['USERNAME'],
            "admin_id" => $user['IDADMIN']
        ]
    ]);
    exit();
}

http_response_code(401);
echo json_encode(["success" => false, "message" => "Invalid username or password"]);
?>
