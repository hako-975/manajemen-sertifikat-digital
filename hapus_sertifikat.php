<?php 
	require_once 'koneksi.php';

	if (!isset($_SESSION['id_user'])) {
		header("Location: login.php");
		exit;
	}

	$id_user = $_SESSION['id_user'];
	$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

	$id_sertifikat = $_GET['id_sertifikat'];
	$sertifikat = mysqli_query($koneksi, "SELECT * FROM sertifikat INNER JOIN user ON sertifikat.id_user = user.id_user WHERE id_sertifikat = '$id_sertifikat'");
	$data_sertifikat = mysqli_fetch_assoc($sertifikat);
	$file_sertifikat = $data_sertifikat['file_sertifikat'];
	$sertifikatKu = false;
	if (isset($_SESSION['id_user'])) {
		$id_user = $_SESSION['id_user'];

		// cek apakah data sertifikat termasuk sertifikat ku
		if ($data_sertifikat['id_user'] == $id_user) {
			$sertifikatKu = true;
		}
	}

	if ($sertifikatKu) {
		$hapus_sertifikat = mysqli_query($koneksi, "DELETE FROM sertifikat WHERE id_sertifikat = '$id_sertifikat' && id_user = '$id_user'");

		if ($hapus_sertifikat) {
			unlink('file/'.$file_sertifikat);
			echo "
				<script>
					alert('sertifikat berhasil dihapus!')
					window.location.href='index.php'
				</script>
			";
			exit;
		} else {
			echo "
				<script>
					alert('sertifikat gagal dihapus!')
					window.history.back()
				</script>
			";
			exit;
		}
	} else {
		echo "
			<script>
				alert('sertifikat gagal dihapus!')
				window.history.back()
			</script>
		";
		exit;
	}
?>