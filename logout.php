<?php
// logout.php
session_start();

// Hapus semua data session
session_destroy();

// Hapus cookie jika ada
if (isset($_COOKIE['remember_me'])) {
    setcookie('remember_me', '', time() - 3600, '/');
}

// Redirect ke halaman login
header('Location: login.php');
exit();
?>