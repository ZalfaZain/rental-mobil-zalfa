<?php
// register.php
session_start();
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitize($_POST['username']);
    $password = $_POST['password'];
    $nama_lengkap = sanitize($_POST['nama_lengkap']);
    $email = sanitize($_POST['email']);
    $no_telp = sanitize($_POST['no_telp']);
    $alamat = sanitize($_POST['alamat']);
    
    // Validasi input
    $errors = [];
    
    // Cek username sudah digunakan atau belum
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->rowCount() > 0) {
        $errors[] = "Username sudah digunakan!";
    }
    
    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid!";
    }
    
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("
            INSERT INTO users (username, password, nama_lengkap, email, no_telp, alamat, role)
            VALUES (?, ?, ?, ?, ?, ?, 'customer')
        ");
        
        if ($stmt->execute([$username, $hashed_password, $nama_lengkap, $email, $no_telp, $alamat])) {
            $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
            header('Location: login.php');
            exit();
        } else {
            $errors[] = "Terjadi kesalahan saat mendaftar.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - PT Bendi Car</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="register-container">
        <h2>Registrasi PT Bendi Car</h2>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="" class="registration-form">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            
            <div class="form-group">
                <label for="no_telp">No. Telepon</label>
                <input type="tel" name="no_telp" id="no_telp" required>
            </div>
            
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3" required></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
        
        <p>Sudah punya akun? <a href="login.php">Login disini</a></p>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>