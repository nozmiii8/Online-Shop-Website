<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Handle image upload
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_dir = "../assets/img/template_$category/";
        $image_name = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $image_dir . $image_name);
        $image = "assets/img/template_$category/" . $image_name;
    }

    // Handle file upload
    $file_path = '';
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $file_dir = "../assets/uploads/template_$category/";
        $file_name = time() . '_' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $file_dir . $file_name);
        $file_path = "assets/uploads/template_$category/" . $file_name;
    }

    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, category, image, file_path) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $description, $price, $category, $image, $file_path]);

    header('Location: manage_products.php');
    exit;
}

require_once 'includes/header.php';
?>

<main>
    <h1>Add Product</h1>
    <form method="POST" enctype="multipart/form-data">
        <table class="admin-form-table">
            <tr>
                <td><label for="name">Product Name</label></td>
                <td><input type="text" id="name" name="name" required></td>
            </tr>
            <tr>
                <td><label for="description">Description</label></td>
                <td><textarea id="description" name="description" required></textarea></td>
            </tr>
            <tr>
                <td><label for="price">Price</label></td>
                <td><input type="number" id="price" step="0.01" name="price" required></td>
            </tr>
            <tr>
                <td><label for="category">Category</label></td>
                <td>
                    <select id="category" name="category" required>
                        <option value="canva">Canva</option>
                        <option value="website">Website</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="image">Image</label></td>
                <td><input type="file" id="image" name="image" accept="image/*" required></td>
            </tr>
            <tr>
                <td><label for="file">File</label></td>
                <td><input type="file" id="file" name="file" required></td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit" class="btn btn-primary">Add Product</button></td>
            </tr>
        </table>
    </form>
    <div class="admin-form-actions">
        <a href="manage_products.php" class="btn btn-secondary">Back to Manage Products</a>
    </div>
</main>

<?php require_once '../includes/footer.php'; ?>
