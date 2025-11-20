<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';

    // Handle profile photo upload
    $profile_photo = $user['profile_photo'];
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {
        if ($profile_photo && file_exists($profile_photo)) unlink($profile_photo);
        $photo_name = time() . '_' . basename($_FILES['profile_photo']['name']);
        $photo_path = 'assets/uploads/profile_photos/' . $photo_name;
        move_uploaded_file($_FILES['profile_photo']['tmp_name'], $photo_path);
        $profile_photo = $photo_path;
    }

    // Handle delete photo
    if (isset($_POST['delete_photo'])) {
        if ($profile_photo && file_exists($profile_photo)) unlink($profile_photo);
        $profile_photo = null;
    }

    // Handle password change
    $password_updated = false;
    if (!empty($_POST['current_password']) && !empty($_POST['new_password'])) {
        if (password_verify($_POST['current_password'], $user['password'])) {
            $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
            $password_updated = true;
        } else {
            $message = 'Current password is incorrect.';
        }
    }

    if (empty($message)) {
        if ($password_updated) {
            $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, phone = ?, profile_photo = ?, password = ? WHERE id = ?");
            $stmt->execute([$username, $email, $phone, $profile_photo, $new_password, $user_id]);
        } else {
            $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, phone = ?, profile_photo = ? WHERE id = ?");
            $stmt->execute([$username, $email, $phone, $profile_photo, $user_id]);
        }
        $message = 'Profile updated successfully!';

        // Refresh user data
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

require_once 'includes/header.php';
?>

<main>
    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <div class="profile-container">
        <h1>My Profile</h1>
        <div class="profile-photo">
            <?php if ($user['profile_photo']): ?>
                <img src="<?php echo $user['profile_photo']; ?>" alt="Profile Photo">
                <form method="post">
                    <button type="submit" name="delete_photo" class="btn btn-danger" onclick="return confirm('Delete photo?')">Delete Photo</button>
                </form>
            <?php else: ?>
                <p>No profile photo</p>
            <?php endif; ?>
        </div>

        <form method="post" enctype="multipart/form-data">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">

            <label for="profile_photo">Change Profile Photo:</label>
            <input type="file" id="profile_photo" name="profile_photo" accept="image/*">

            <h3>Change Password (optional)</h3>
            <label for="current_password">Current Password:</label>
            <input type="password" id="current_password" name="current_password">

            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password">

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>
