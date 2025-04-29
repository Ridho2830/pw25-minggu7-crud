<?php
session_start();
include 'connect.php';

if (isset($_SESSION['user_id'])) {
    // Reset status login di database
    $stmt = $conn->prepare("UPDATE crud_134 SET is_logged_in = FALSE, session_id = NULL WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $stmt->close();
    
    // Hapus semua data session
    session_unset();
    session_destroy();
}

$conn->close();
header("Location: ../html/index.php");
exit;
?>