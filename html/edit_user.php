<?php
session_start();
include('../config/connect.php'); // koneksi harus benar

// Cek kalau bukan admin, tendang keluar
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../html/index.php");
    exit;
}

// Pastikan ada ID yang dikirim
if (!isset($_GET['id'])) {
    header("Location: ../html/dashboard_admin.php");
    exit;
}

$id = intval($_GET['id']);

// Ambil data user berdasarkan ID
$stmt = $conn->prepare("SELECT * FROM crud_134 WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "User tidak ditemukan!";
    exit;
}

$user = $result->fetch_assoc();

// Update data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $nama = trim($_POST['nama']);
    $alamat = trim($_POST['alamat']);
    $email = trim($_POST['email']);
    $noTelp = trim($_POST['noTelp']);
    $role = $_POST['role'];

    $update_stmt = $conn->prepare("UPDATE crud_134 SET username=?, nama=?, alamat=?, email=?, noTelp=?, role=? WHERE id=?");
    $update_stmt->bind_param("ssssssi", $username, $nama, $alamat, $email, $noTelp, $role, $id);

    if ($update_stmt->execute()) {
        header("Location: ../html/dashboard_admin.php");
        exit;
    } else {
        echo "Gagal mengupdate data: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="../css/edit_user.css">
    <link rel="icon" type="image/jpg" href="../assets/logo_kelas.jpg">

</head>

<body>
    <h1>Edit Data Anggota</h1>

    <form method="POST" action="">
        <label>Username:</label><br>
        <input type="text" name="username" value="<?= htmlspecialchars($user['username']); ?>" required><br><br>

        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?= htmlspecialchars($user['nama']); ?>" required><br><br>

        <label>Alamat:</label><br>
        <input type="text" name="alamat" value="<?= htmlspecialchars($user['alamat']); ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required><br><br>

        <label>No. Telepon:</label><br>
        <input type="text" name="noTelp" value="<?= htmlspecialchars($user['noTelp']); ?>" required><br><br>

        <label>Role:</label><br>
        <select name="role" required>
            <option value="user" <?= $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
        </select><br><br>

        <button type="submit">Simpan</button>
        <a href="../html/dashboard_admin.php">Batal</a>
    </form>
</body>

</html>