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
  <title>Login</title>
  <link rel="stylesheet" href="../css/signin.css" />
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
    <div class="signin-container">
      <div class="signin-header">
        <h2>Selamat Datang Kembali!</h2>
        <p>Silakan login dengan akun Anda</p>
      </div>

      <form action="../config/signin_process.php" method="POST">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Masukkan Username" required />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Masukkan Password" required />

        <button type="submit">Masuk</button>

        <p>Belum Punya Akun? <a href="signup.php">Daftar</a></p>
      </form>
    </div>
  </main>
</body>

</html>