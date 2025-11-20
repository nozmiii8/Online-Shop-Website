<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = $_GET['id'];

$stmt = $pdo->prepare("SELECT file_path FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Product not found.";
    exit;
}

$relativePath = $product['file_path']; 
$absolutePath = __DIR__ . '/' . $relativePath;

if (!file_exists($absolutePath)) {
    echo "File not found.<br>";
    echo "Tried path: " . $absolutePath;
    exit;
}

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($absolutePath) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($absolutePath));

readfile($absolutePath);
exit;
?>