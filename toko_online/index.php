<?php
session_start();
require_once 'config.php';

$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once 'includes/header.php';
?>

<main>
    <h1>Dashboard - Toko Online Template</h1>
    <div class="search-container">
        <input type="text" id="search-input" placeholder="Cari produk...">
    </div>
    <div class="products">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                <div class="content">
                    <h3><?php echo $product['name']; ?></h3>
                    <p><?php echo $product['description']; ?></p>
                    <div class="price-and-button">
                        <p class="price">$<?php echo $product['price']; ?></p>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <button class="buy-btn" data-id="<?php echo $product['id']; ?>">Buy Now</button>
                        <?php else: ?>
                            <a href="login.php" class="login-link">Login to Buy</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Buy Popup -->
    <div id="buy-popup" class="popup">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>Confirm Purchase</h2>
            <p>Are you sure you want to buy this product?</p>
            <button id="confirm-yes">Yes</button>
            <button id="confirm-no">No</button>
        </div>
    </div>

    <!-- QRIS Popup -->
    <div id="qris-popup" class="popup">
        <div class="popup-content">
            <h2>Scan QRIS to Pay</h2>
            <img src="assets/img/qris.png" alt="QRIS">
            <p>Processing payment...</p>
            <div id="timer">10</div>
        </div>
    </div>

    <!-- Success Popup -->
    <div id="success-popup" class="popup">
        <div class="popup-content">
            <h2>Payment Successful!</h2>
            <button id="download-btn">Download</button>
        </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>
