<?php
session_start();
include('../config/connect.php');

// Cek apakah user sudah login dan role-nya user
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header("Location: index.php");
    exit;
}

// Ambil data user dari database berdasarkan user_id yang sedang login
$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM crud_134 WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard User</title>
    <link rel="stylesheet" href="../css/dashboard_user.css">
    <link rel="icon" type="image/jpg" href="../assets/logo_kelas.jpg">

</head>

<body>
    <h1>Dashboard User</h1>
    <p>Halo, <?php echo htmlspecialchars($user['nama']); ?>! Selamat datang di aplikasi.</p>

    <h2>Informasi Akun:</h2>
    <ul>
        <li><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></li>
        <li><strong>Nama:</strong> <?php echo htmlspecialchars($user['nama']); ?></li>
        <li><strong>Alamat:</strong> <?php echo htmlspecialchars($user['alamat']); ?></li>
        <li><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></li>
        <li><strong>No Telepon:</strong> <?php echo htmlspecialchars($user['noTelp']); ?></li>
        <li><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></li>
        <li><strong>Login Sejak:</strong> <?php echo date('d-m-Y H:i:s', $_SESSION['login_time']); ?></li>
    </ul>

    <div style="text-align: center;">
        <a href="../config/logout.php">Logout</a>
    </div>
</body>

</html>