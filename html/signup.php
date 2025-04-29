<?php
session_start();
if (isset($_SESSION['error'])) {
  echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                alert('" . $_SESSION['error'] . "');
            });
          </script>";
  unset($_SESSION['error']); // Hapus session error setelah ditampilkan
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Akun Baru</title>
  <link rel="stylesheet" href="../css/signup.css" />
  <link rel="icon" type="image/jpg" href="../assets/logo_kelas.jpg">
</head>

<body>
  <header>
    <h1>F1D02310134</h1>
    <nav>
      <a href="home.php">Beranda</a>
      <a href="about.php">Tentang Kami</a>
    </nav>
  </header>

  <main>
    <div class="signup-container">
      <div class="signup-header">
        <h2>Daftar Anggota Baru</h2>
        <p>Silakan lengkapi data Anda untuk membuat akun</p>
      </div>

      <form action="../config/signup_process.php" method="POST">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Masukkan Username" required />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Masukkan Password" required />

        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" required>

        <label for="alamat">Alamat</label>
        <input type="text" id="alamat" name="alamat" placeholder="Masukkan Alamat" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Masukkan Email" required>

        <label for="noTelp">No. Telephone</label>
        <input type="text" id="noTelp" name="noTelp" placeholder="Masukkan No. Telephone" required>

        <!-- Role field for the user type (admin or user) -->
        <label for="role">Role</label>
        <select id="role" name="role" required>
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>

        <button type="submit">Daftar</button>

        <p>Sudah Punya Akun? <a href="index.php">Masuk</a></p>
      </form>

    </div>
  </main>
</body>

</html>