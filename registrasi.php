<?php
    require_once 'koneksi.php';
    
    if (isset($_SESSION['id_user'])) {
        echo "
            <script>
                window.location='index.php'
            </script>
        ";
        exit;
    }

    if (isset($_POST['btnRegistrasi'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = $_POST['password'];
        $ketik_ulang_password = $_POST['ketik_ulang_password'];
        $nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
        
        // check username 
        $query_user = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
        
        if (mysqli_num_rows($query_user) > 0) {
            echo "
                <script>
                    alert('Username sudah digunakan!')
                    window.history.back();
                </script>
            ";
            exit;
        }

        if ($password != $ketik_ulang_password) {
            echo "
                <script>
                    alert('Password harus sama dengan Ketik Ulang Password!')
                    window.history.back();
                </script>
            ";
            exit;
        }
        
        $password = password_hash($password, PASSWORD_DEFAULT);

        $insert_user = mysqli_query($koneksi, "INSERT INTO user (username, password, nama_lengkap) VALUES ('$username', '$password', '$nama_lengkap')");
        if ($insert_user) {
            echo "
                <script>
                    alert('Registrasi berhasil!')
                    window.location.href='login.php'
                </script>
            ";
            exit;
        }
    }
?>


<html>
<head>
    <title>Registrasi - Manajemen Sertifikat Digital</title>
    <?php include_once 'head.php'; ?>
</head>
<body>
    <?php include_once 'navbar.php'; ?>
    
    <div class="container">
        <img src="img/logo.png" class="logo-middle" alt="logo">
        <form method="post" class="login-form">
          <h2>Registrasi</h2>
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required>
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
          <label for="ketik_ulang_password">Ketik Ulang Password:</label>
          <input type="password" id="ketik_ulang_password" name="ketik_ulang_password" required>
          <label for="nama_lengkap">Nama Lengkap:</label>
          <input type="text" id="nama_lengkap" name="nama_lengkap" required>
          <button type="submit" name="btnRegistrasi" class="btn">Registrasi</button>
        </form>
        <a href="login.php" class="text-link">Sudah punya akun? Login</a>
    </div>

</body>
</html>