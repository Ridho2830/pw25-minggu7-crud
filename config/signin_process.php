<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Menggunakan prepared statement untuk menghindari SQL Injection
    $stmt = $conn->prepare("SELECT id, password, is_logged_in, session_id, role FROM crud_134 WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // // Cek apakah user sudah login di device lain
            // if ($user['is_logged_in'] && $user['session_id'] != '' && $user['session_id'] != session_id()) {
            //     $_SESSION['error'] = "Akun sedang digunakan di device lain. Silakan logout terlebih dahulu.";
            //     $stmt->close();
            //     $conn->close();
            //     header("Location: ../html/signin.php");
            //     exit;
            // }

            // Set session dan update status login di database
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            $_SESSION['login_time'] = time();
            $_SESSION['role'] = $user['role'];  // Simpan role di session

            // Update status login dan session_id di database
            $update_stmt = $conn->prepare("UPDATE crud_134 SET is_logged_in = TRUE, session_id = ?, last_activity = NOW() WHERE id = ?");
            $session_id = session_id();
            $update_stmt->bind_param("si", $session_id, $user['id']);
            $update_stmt->execute();
            $update_stmt->close();

            // Redirect berdasarkan role (admin atau user)
            if ($user['role'] == 'admin') {
                header("Location: ../html/dashboard_admin.php");
            } else {
                header("Location: ../html/dashboard_user.php");
            }
            exit;
        } else {
            $_SESSION['error'] = "Login gagal! Password salah.";
        }
    } else {
        $_SESSION['error'] = "Login gagal! Username tidak ditemukan.";
    }

    $stmt->close();
    $conn->close();
}

// Redirect kembali ke halaman login jika gagal
header("Location: ../html/index.php");
exit;
?>
