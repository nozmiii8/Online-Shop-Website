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
    header('Location: manage_users.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user) {
    header('Location: manage_users.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $role = $_POST['role'] ?? 'user';

    $profile_photo = $user['profile_photo'];
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {
        if ($profile_photo && file_exists($profile_photo)) unlink($profile_photo);
        $photo_name = time() . '_' . basename($_FILES['profile_photo']['name']);
        $photo_path = '../assets/uploads/profile_photos/' . $photo_name;
        move_uploaded_file($_FILES['profile_photo']['tmp_name'], $photo_path);
        $profile_photo = $photo_path;
    }

    $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, phone = ?, role = ?, profile_photo = ? WHERE id = ?");
    $stmt->execute([$username, $email, $phone, $role, $profile_photo, $id]);

    $message = 'User updated successfully!';
    // Refresh user data
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

require_once 'includes/header.php';
?>

<main>
    <h1>Edit User</h1>
    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <table class="admin-form-table">
            <tr>
                <td><label for="username">Username:</label></td>
                <td><input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="text" id="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>"></td>
            </tr>
            <tr>
                <td><label for="phone">Phone:</label></td>
                <td><input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>"></td>
            </tr>
            <tr>
                <td><label for="role">Role:</label></td>
                <td>
                    <select id="role" name="role" required>
                        <option value="user" <?php echo $user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                        <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="profile_photo">Profile Photo:</label></td>
                <td>
                    <input type="file" id="profile_photo" name="profile_photo" accept="image/*">
                    <?php if ($user['profile_photo']): ?>
                        <p>Current: <img src="<?php echo $user['profile_photo']; ?>" alt="Current Photo" style="max-width: 100px;"></p>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit" class="btn btn-primary">Update User</button></td>
            </tr>
        </table>
    </form>
    <div class="admin-form-actions">
        <a href="manage_users.php" class="btn btn-secondary">Back to Manage Users</a>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>
