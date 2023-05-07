<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));


$sertifikat = mysqli_query($koneksi, "SELECT * FROM sertifikat INNER JOIN user ON sertifikat.id_user = user.id_user WHERE sertifikat.id_user = '$id_user' ORDER BY tanggal_diterima DESC");

?>


<html>
<head>
    <title>Dashboard - Manajemen Sertifikat Digital</title>
    <?php include_once 'head.php'; ?>
</head>
<body>
    <?php include_once 'navbar.php'; ?>

    <div class="container">
        
    </div>

</body>
</html>