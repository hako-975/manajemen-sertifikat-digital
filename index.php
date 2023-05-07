<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

$sertifikat = mysqli_query($koneksi, "SELECT * FROM sertifikat INNER JOIN user ON sertifikat.id_user = user.id_user WHERE sertifikat.id_user = '$id_user' ORDER BY judul ASC");

if (isset($_POST['btnCari'])) {
    $keyword = $_POST['keyword'];
    $sertifikat = mysqli_query($koneksi, "SELECT * FROM sertifikat INNER JOIN user ON sertifikat.id_user = user.id_user WHERE sertifikat.id_user = '$id_user' 
        AND user.id_user = '$id_user' 
        AND (judul LIKE '%$keyword%' 
        OR keterangan LIKE '%$keyword%'
        OR tanggal_diterima LIKE '%$keyword%'
        OR tanggal_kedaluwarsa LIKE '%$keyword%'
        OR file_sertifikat LIKE '%$keyword%')
        ORDER BY tanggal_diterima DESC");

}

?>


<html>
<head>
    <title>Dashboard - Manajemen Sertifikat Digital</title>
    <?php include_once 'head.php'; ?>
</head>
<body>
    <?php include_once 'navbar.php'; ?>

    <div class="container">
        <h1 class="text-center">Daftar Sertifikat</h1>
        <div>
            <div style="float: left;">
                <form method="post" class="form-search">
                    <input type="text" name="keyword" id="keyword" required value="<?= (isset($_POST['btnCari'])) ? $keyword : ''; ?>">
                    <button type="submit" name="btnCari" class="btn">Cari</button>
                    <?php if (isset($_POST['btnCari'])): ?>
                        <button type="button" onclick="return window.location.href='index.php'" class="btn">Reset</button>
                    <?php endif ?>
                </form>
            </div>
            <div style="float: right;">
                <a class="btn" href="tambah_sertifikat.php">Tambah Sertifikat</a>
            </div>
        </div>
        <?php if (isset($_POST['btnCari'])): ?>
            <h2>Cari: <?= $keyword; ?></h2>
        <?php endif ?>
        <div class="table-responsive" style="clear: both;">
            <table border="1" cellpadding="10" cellspacing="0">
            	<thead>
            		<tr>
            			<th>No</th>
            			<th>Judul</th>
            			<th>Keterangan</th>
            			<th>Tanggal Diterima</th>
            			<th>Tanggal Kedaluwarsa</th>
            			<th>File Sertifikat</th>
                        <th>Aksi</th>
            		</tr>
            	</thead>
            	<tbody>
            		<?php $i = 1; ?>
            		<?php foreach ($sertifikat as $data_sertifikat): ?>
            			<tr>
            				<td><?= $i++; ?></td>
            				<td><?= $data_sertifikat['judul']; ?></td>
            				<td><?= strip_tags($data_sertifikat['keterangan']); ?></td>
            				<td><?= date("d-m-Y", strtotime($data_sertifikat['tanggal_diterima'])); ?></td>
            				<td>
            					<?php if ($data_sertifikat['tanggal_kedaluwarsa'] == '0000-00-00'): ?>
    	        					Tidak ada Kedaluwarsa	
            					<?php else: ?>
            						<?= date("d-m-Y", strtotime($data_sertifikat['tanggal_kedaluwarsa'])); ?>
            					<?php endif ?>
            				</td>
                            <td>
                                <a href="file/<?= $data_sertifikat['file_sertifikat']; ?>" target="_blank"><?= $data_sertifikat['file_sertifikat']; ?></a>
                            </td>
                            <td>
                                <a href="file/<?= $data_sertifikat['file_sertifikat']; ?>" target="_blank" class="btn">Unduh</a>
                                <a href="ubah_sertifikat.php?id_sertifikat=<?= $data_sertifikat['id_sertifikat']; ?>" class="btn">Ubah</a>
                                <a href="hapus_sertifikat.php?id_sertifikat=<?= $data_sertifikat['id_sertifikat']; ?>" class="btn" onclick="return confirm('Apakah Anda yakin ingin menghapus Sertifikat <?= $data_sertifikat['judul'] ?>?')">Hapus</a>
                            </td>
            			</tr>
            		<?php endforeach ?>
            	</tbody>
            </table>
        </div>
    </div>

</body>
</html>