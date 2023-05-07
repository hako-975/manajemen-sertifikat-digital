<nav class="navbar">
  <div class="navbar-container">
    <a class="navbar-title" href="index.php"><img src="img/logo-no-text.png"> <span>Manajemen Sertifikat Digital</span></a>
    <div class="navbar-button">
      <?php if (isset($_SESSION['id_user'])): ?>
        <a href="tambah_sertifikat.php">Tambah Sertifikat</a>
        <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
      <?php else: ?>
        <a href="registrasi.php">Registrasi</a>
        <a href="login.php">Login</a>
      <?php endif ?>
    </div>
  </div>
</nav>