<?php
session_start();
include ('../config/connect.php'); // koneksi harus benar

// Pastikan yang akses admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit;
}

// Pastikan ada ID user yang akan dihapus
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    // Admin tidak boleh menghapus dirinya sendiri
    if ($user_id == $_SESSION['user_id']) {
        $_SESSION['error'] = "Anda tidak bisa menghapus akun sendiri.";
        header("Location: dashboard_admin.php");
        exit;
    }

    // Hapus user
    $stmt = $conn->prepare("DELETE FROM crud_134 WHERE id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "User berhasil dihapus.";
    } else {
        $_SESSION['error'] = "Gagal menghapus user.";
    }

    $stmt->close();
}

$conn->close();
header("Location: dashboard_admin.php");
exit;
?>
