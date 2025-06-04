<?php
// config/cors.php

// Atur header CORS
header("Access-Control-Allow-Origin: *"); // Ganti '*' dengan domain frontend yang diizinkan jika perlu lebih aman
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Jika request method OPTIONS (preflight), langsung kirim response 200 tanpa eksekusi lanjut
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
