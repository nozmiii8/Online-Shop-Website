<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
    exit;
}

$message = '';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: manage_products.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$product) {
    header('Location: manage_products.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $image = $product['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        if ($image && file_exists($image)) unlink($image);
        $image_name = time() . '_' . basename($_FILES['image']['name']);
        $image_path = '../assets/uploads/template_' . $category . '/' . $image_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
        $image = $image_path;
    }

    $file_path = $product['file_path'];
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        if ($file_path && file_exists($file_path)) unlink($file_path);
        $file_name = time() . '_' . basename($_FILES['file']['name']);
        $file_path_full = '../assets/uploads/template_' . $category . '/' . $file_name;
        move_uploaded_file($_FILES['file']['tmp_name'], $file_path_full);
        $file_path = $file_path_full;
    }

    $stmt = $pdo->prepare("UPDATE products SET name = ?, description = ?, price = ?, category = ?, image = ?, file_path = ? WHERE id = ?");
    $stmt->execute([$name, $description, $price, $category, $image, $file_path, $id]);

    $message = 'Product updated successfully!';
    // Refresh product data
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
}

require_once 'includes/header.php';
?>

<main>
    <h1>Edit Product</h1>
    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <table class="admin-form-table">
            <tr>
                <td><label for="name">Name:</label></td>
                <td><input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required></td>
            </tr>
            <tr>
                <td><label for="description">Description:</label></td>
                <td><textarea id="description" name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea></td>
            </tr>
            <tr>
                <td><label for="price">Price:</label></td>
                <td><input type="number" step="0.01" id="price" name="price" value="<?php echo $product['price']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="category">Category:</label></td>
                <td>
                    <select id="category" name="category" required>
                        <option value="canva" <?php echo $product['category'] == 'canva' ? 'selected' : ''; ?>>Canva</option>
                        <option value="website" <?php echo $product['category'] == 'website' ? 'selected' : ''; ?>>Website</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="image">Image:</label></td>
                <td>
                    <input type="file" id="image" name="image" accept="image/*">
                    <?php if ($product['image']): ?>
                        <p>Current: <img src="<?php echo $product['image']; ?>" alt="Current Image" style="max-width: 100px;"></p>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td><label for="file">File:</label></td>
                <td>
                    <input type="file" id="file" name="file" accept=".zip">
                    <?php if ($product['file_path']): ?>
                        <p>Current: <?php echo basename($product['file_path']); ?></p>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit" class="btn btn-primary">Update Product</button></td>
            </tr>
        </table>
    </form>
    <div class="admin-form-actions">
        <a href="manage_products.php" class="btn btn-secondary">Back to Manage Products</a>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>
