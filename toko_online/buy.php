<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id'];

    // Check if already purchased
    $stmt = $pdo->prepare("SELECT * FROM purchases WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$user_id, $product_id]);
    if ($stmt->fetch()) {
        echo json_encode(['status' => 'already_purchased']);
        exit;
    }

    // Simulate payment success after 10 seconds (in real, integrate payment gateway)
    sleep(10);

    // Add to purchases
    $stmt = $pdo->prepare("INSERT INTO purchases (user_id, product_id) VALUES (?, ?)");
    $stmt->execute([$user_id, $product_id]);

    // Get product file
    $stmt = $pdo->prepare("SELECT file_path FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode(['status' => 'success', 'file' => $product['file_path']]);
} else {
    echo json_encode(['status' => 'error']);
}
?>
