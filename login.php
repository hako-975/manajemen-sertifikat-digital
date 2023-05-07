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

    if (isset($_POST['btnLogin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query_login = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
        
        if ($data_user = mysqli_fetch_assoc($query_login)) {
            if (password_verify($password, $data_user['password'])) {
                $_SESSION['id_user'] = $data_user['id_user'];
                header("Location: index.php");
                exit;
            } else {
                echo "
                    <script>
                        alert('Gagal Username atau Password salah!')
                        window.history.back()
                    </script>
                ";
                exit;
            }
        } else {
            echo "
                <script>
                    alert('Gagal Username atau Password salah!')
                    window.history.back()
                </script>
            ";
            exit;
        }
    }
?>


<html>
<head>
    <title>Login - Manajemen Sertifikat Digital</title>
    <?php include_once 'head.php'; ?>
</head>
<body>
    <?php include_once 'navbar.php'; ?>

    <div class="container">
        <img src="img/logo.png" class="logo-middle" alt="logo">
        <form method="post" class="login-form">
          <h2>Login</h2>
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required>
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
          <button type="submit" name="btnLogin" class="btn">Login</button>
        </form>
        <a href="registrasi.php" class="text-link">Belum punya akun? Registrasi</a>
    </div>

</body>
</html>