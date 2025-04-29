<?php
session_start();
include('../config/connect.php');

// Pastikan hanya admin yang bisa akses
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $noTelp = $_POST['noTelp'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password

    $query = "INSERT INTO crud_134 (username, nama, alamat, email, noTelp, role, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssss", $username, $nama, $alamat, $email, $noTelp, $role, $password);

    if ($stmt->execute()) {
        header("Location: dashboard_admin.php?status=sukses");
        exit;
    } else {
        $error = "Gagal menambahkan user: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
    <link rel="stylesheet" href="../css/tambah_user.css">
    <link rel="icon" type="image/jpg" href="../assets/logo_kelas.jpg">

</head>

<body>
    <h1>Tambah User Baru</h1>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Nama:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Alamat:</label><br>
        <textarea name="alamat" required></textarea><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>No Telepon:</label><br>
        <input type="text" name="noTelp" required><br><br>

        <label>Role:</label><br>
        <select name="role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="dashboard_admin.php">Kembali ke Dashboard</a>
</body>

</html>