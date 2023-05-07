<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));


?>


<html>
<head>
    <title>Profile - <?= $data_user['username']; ?></title>
    <?php include_once 'head.php'; ?>
</head>
<body>
    <?php include_once 'navbar.php'; ?>

    <div class="container">
        <h1 class="text-center">Profile</h1>
        <table class="profile" cellpadding="10">
          <tr>
            <td>Username</td>
            <td>: <?= $data_user['username']; ?></td>
          </tr>
          <tr>
            <td>Nama Lengkap</td>
            <td>: <?= $data_user['nama_lengkap']; ?></td>
          </tr>
          <tr>
            <td>
                <a href="ubah_profile.php" class="btn">Ubah Profile</a>
            </td>
            <td>
                <a href="ubah_password.php" class="btn">Ubah Password</a>
            </td>
          </tr>
        </table>
    </div>

</body>
</html>