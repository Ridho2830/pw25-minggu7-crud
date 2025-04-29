<?php
session_start();
include('../config/connect.php'); // koneksi harus benar

// Cek kalau bukan admin, tendang keluar
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Ambil data semua user
$query = "SELECT * FROM crud_134";
$result = $conn->query($query);

if (!$result) {
    die("Query Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../css/dashboard_admin.css">
    <link rel="icon" type="image/jpg" href="../assets/logo_kelas.jpg">
</head>

<body>
    <h1>Dashboard Admin</h1>
    <p>Selamat datang, Admin <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    <a href="tambah_user.php" class="add-button">Tambah Anggota</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>No Telp</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $result->fetch_assoc()): ?>
                <tr>
                    <td data-label="ID"><?= $user['id']; ?></td>
                    <td data-label="Username"><?= htmlspecialchars($user['username']); ?></td>
                    <td data-label="Nama"><?= htmlspecialchars($user['nama']); ?></td>
                    <td data-label="Alamat"><?= htmlspecialchars($user['alamat']); ?></td>
                    <td data-label="Email"><?= htmlspecialchars($user['email']); ?></td>
                    <td data-label="No Telp"><?= htmlspecialchars($user['noTelp']); ?></td>
                    <td data-label="Role"><?= htmlspecialchars($user['role']); ?></td>
                    <td data-label="Action">
                        <a href="edit_user.php?id=<?= $user['id']; ?>">Edit</a> |
                        <a href="hapus_user.php?id=<?= $user['id']; ?>"
                            onclick="return confirm('Yakin hapus user ini?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <br>
    <a href="../config/logout.php" class="logout-button">Logout</a>
</body>

</html>