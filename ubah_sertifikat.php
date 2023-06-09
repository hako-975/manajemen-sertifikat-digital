<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

$id_sertifikat = $_GET['id_sertifikat'];
$sertifikat = mysqli_query($koneksi, "SELECT * FROM sertifikat INNER JOIN user ON sertifikat.id_user = user.id_user LEFT JOIN penilaian ON sertifikat.id_sertifikat = penilaian.id_sertifikat WHERE sertifikat.id_sertifikat = '$id_sertifikat' && sertifikat.id_user = '$id_user'");
$data_sertifikat = mysqli_fetch_assoc($sertifikat);

$sertifikatKu = false;
if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];

    // cek apakah data sertifikat termasuk sertifikat ku
    if ($data_sertifikat) {
        if ($data_sertifikat['id_user'] == $id_user) {
            $sertifikatKu = true;
        }
    }
}

if ($sertifikatKu == false) {
    echo "
        <script>
            alert('Sertifikat gagal diubah!')
            window.history.back()
        </script>
    ";
    exit;
}

if (isset($_POST['btnUbah'])) {
    $judul = htmlspecialchars($_POST['judul']);
    $keterangan = nl2br($_POST['keterangan']);
    $tanggal_diterima = htmlspecialchars($_POST['tanggal_diterima']);
    $nilai = htmlspecialchars($_POST['nilai']);
    if (isset($_POST['kedaluwarsa'])) {
        if ($_POST['kedaluwarsa'] == "on") {
            $tanggal_kedaluwarsa = htmlspecialchars($_POST['tanggal_kedaluwarsa']);
        }
    } else {
        $tanggal_kedaluwarsa = null;
    }
    
    $file_sertifikat = $_POST['file_sertifikat_old'];

    $file_sertifikat_new = $_FILES['file_sertifikat']['name'];
    if ($file_sertifikat_new != '') {
        $acc_extension = array('png','jpg', 'jpeg', 'gif', 'pdf');
        $extension = explode('.', $file_sertifikat_new);
        $extension_lower = strtolower(end($extension));
        $size = $_FILES['file_sertifikat']['size'];
        $file_tmp = $_FILES['file_sertifikat']['tmp_name'];   
        
        if(!in_array($extension_lower, $acc_extension))
        {
            echo "
                <script>
                    alert('File yang Anda upload tidak sesuai format!')
                    window.history.back()
                </script>
            ";
            exit;
        }

        unlink('file/'.$file_sertifikat);

        $file_sertifikat = uniqid() . $file_sertifikat_new;
        move_uploaded_file($file_tmp, 'file/'. $file_sertifikat);
    }

    $ubah_sertifikat = mysqli_query($koneksi, "UPDATE sertifikat SET judul = '$judul', keterangan = '$keterangan', tanggal_diterima = '$tanggal_diterima', tanggal_kedaluwarsa = '$tanggal_kedaluwarsa', file_sertifikat = '$file_sertifikat' WHERE id_sertifikat = '$id_sertifikat' && id_user = '$id_user'");

    if ($ubah_sertifikat) {
        $ubah_nilai = mysqli_query($koneksi, "UPDATE penilaian SET nilai = '$nilai' WHERE id_sertifikat = '$id_sertifikat'");

        echo "
            <script>
                alert('Sertifikat berhasil diubah!')
                window.location.href='index.php'
            </script>
        ";
        exit;
    } else {
        echo "
            <script>
                alert('Sertifikat gagal diubah!')
                window.history.back()
            </script>
        ";
        exit;
    }
}

?>


<html>
<head>
    <title>Ubah Sertifikat - <?= $data_sertifikat['judul']; ?></title>
    <?php include_once 'head.php'; ?>
</head>
<body>
    <?php include_once 'navbar.php'; ?>

    <div class="container">
        <form method="post" class="login-form" enctype="multipart/form-data">
            <input type="hidden" name="file_sertifikat_old" value="<?= $data_sertifikat['file_sertifikat']; ?>">
            <h2>Ubah Sertifikat - <?= $data_sertifikat['judul']; ?></h2>
            <label for="judul">Judul:</label>
            <input type="text" id="judul" name="judul" value="<?= $data_sertifikat['judul']; ?>" required>
            <label for="keterangan">Keterangan:</label>
            <textarea id="keterangan" name="keterangan" required><?= $data_sertifikat['keterangan']; ?></textarea>
            <label for="tanggal_diterima">Tanggal Diterima:</label>
            <input type="date" id="tanggal_diterima" name="tanggal_diterima" required value="<?= date("Y-m-d", strtotime($data_sertifikat['tanggal_diterima'])); ?>">
            <label for="kedaluwarsa">Dapat Kedaluwarsa?</label>
            <?php if ($data_sertifikat['tanggal_kedaluwarsa'] == '0000-00-00'): ?>
                <input type="checkbox" name="kedaluwarsa" id="kedaluwarsa" class="checkbox">
                <div style="display: none;" id="form_tanggal_kedaluwarsa">
                    <label for="tanggal_kedaluwarsa">Tanggal Kedaluwarsa:</label>
                    <input type="date" id="tanggal_kedaluwarsa" name="tanggal_kedaluwarsa" value="<?= date("Y-m-d", strtotime($data_sertifikat['tanggal_kedaluwarsa'])); ?>">
                </div>
            <?php else: ?>
                <input type="checkbox" name="kedaluwarsa" id="kedaluwarsa" class="checkbox" checked>
                <div id="form_tanggal_kedaluwarsa">
                    <label for="tanggal_kedaluwarsa">Tanggal Kedaluwarsa:</label>
                    <input type="date" id="tanggal_kedaluwarsa" name="tanggal_kedaluwarsa" value="<?= date("Y-m-d", strtotime($data_sertifikat['tanggal_kedaluwarsa'])); ?>">
                </div>
            <?php endif ?>
            <label for="file_sertifikat">File Sertifikat: <br> (Upload File baru jika ingin mengubah file)</label>
            <input type="file" name="file_sertifikat" id="file_sertifikat">
            <label for="nilai">Nilai:</label>
            <input type="number" id="nilai" name="nilai" value="<?= $data_sertifikat['nilai']; ?>" required>
            <button type="submit" name="btnUbah" class="btn">Kirim</button>
        </form>
    </div>
    <script>
        const checkbox = document.getElementById('kedaluwarsa');
        const form = document.getElementById('form_tanggal_kedaluwarsa');

        checkbox.addEventListener('change', function() {
            if (this.checked) {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        });
    </script>
</body>
</html>