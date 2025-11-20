<?php
session_start();
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, phone) VALUES (?, ?, ?, ?)");
    try {
        $stmt->execute([$username, $email, $password, $phone]);
        header('Location: login.php');
        exit;
    } catch (PDOException $e) {
        $error = "Email already exists";
    }
}

require_once 'includes/header.php';
?>

<main>
    <div class="auth-container">
        <h1>Register</h1>
        <form method="POST" class="auth-form">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" placeholder="Phone">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        </form>
        <p class="auth-link">click to return <a href="manage_users.php">back</a></p>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>
