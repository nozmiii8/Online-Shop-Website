<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
    exit;
}

require_once 'includes/header.php';
?>

<main class="admin-panel">
    <h1>COMING SOON</h1>
</main>

<?php require_once 'includes/footer.php'; ?>
