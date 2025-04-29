<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $role = $_POST['role']; // Menyimpan role user yang dipilih (user/admin)
    $nama = trim($_POST['nama']);
    $alamat = trim($_POST['alamat']);
    $email = trim($_POST['email']);
    $noTelp = trim($_POST['noTelp']);

    // Periksa apakah username sudah digunakan
    $check_sql = "SELECT id FROM crud_134 WHERE username = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $_SESSION['error'] = "Username sudah digunakan. Silakan pilih username lain.";
        header("Location: ../pages/signup.php");
    } else {
        // Menambahkan user baru ke database
        $sql = "INSERT INTO crud_134 (username, password, role, nama, alamat, email, noTelp) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $username, $password, $role, $nama, $alamat, $email, $noTelp);

        if ($stmt->execute()) {
            $_SESSION["error"] = "Akun berhasil dibuat!";
            header("Location: ../html/index.php");
        } else {
            $_SESSION['error'] = "Terjadi kesalahan. Coba lagi nanti.";
            header("Location: ../html/signup.php");
        }

        $stmt->close();
    }

    $check_stmt->close();
    $conn->close();
}
?>
