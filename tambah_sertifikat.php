<?php 
require_once 'koneksi.php';
if (!isset($_SESSION['id_user'])) {
	header("Location: login.php");
	exit;
}

$id_user = $_SESSION['id_user'];
$data_user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'"));

if (isset($_POST['btnTambah'])) {
    $judul = htmlspecialchars($_POST['judul']);
    $keterangan = nl2br($_POST['keterangan']);
    $tanggal_diterima = htmlspecialchars($_POST['tanggal_diterima']);
    $nilai = htmlspecialchars($_POST['nilai']);

    if (isset($_POST['tanggal_kedaluwarsa'])) {
        $tanggal_kedaluwarsa = htmlspecialchars($_POST['tanggal_kedaluwarsa']);
    } else {
        $tanggal_kedaluwarsa = null;
    }
    
    $file_sertifikat = $_FILES['file_sertifikat']['name'];
    if ($file_sertifikat != '') {
        $acc_extension = array('png','jpg', 'jpeg', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'csv', 'ppt', 'pptx');
        $extension = explode('.', $file_sertifikat);
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

        $file_sertifikat = uniqid() .'-'. $file_sertifikat;
        move_uploaded_file($file_tmp, 'file/'. $file_sertifikat);
    }
    else
    {
        $file_sertifikat = '';
    }

    $tambah_sertifikat = mysqli_query($koneksi, "INSERT INTO sertifikat VALUES ('', '$judul', '$keterangan', '$tanggal_diterima', '$tanggal_kedaluwarsa', '$file_sertifikat', '$id_user')");

    if ($tambah_sertifikat) {
        $id_sertifikat = mysqli_insert_id($koneksi);

        $tambah_nilai = mysqli_query($koneksi, "INSERT INTO penilaian VALUES ('', '$id_sertifikat', '$nilai')");

        echo "
            <script>
                alert('Sertifikat berhasil ditambahkan!')
                window.location.href='index.php'
            </script>
        ";
        exit;
    } else {
        echo "
            <script>
                alert('Sertifikat gagal ditambahkan!')
                window.history.back()
            </script>
        ";
        exit;
    }
}

?>


<html>
<head>
    <title>Tambah Sertifikat - Manajemen Sertifikat Digital</title>
    <?php include_once 'head.php'; ?>
</head>
<body>
    <?php include_once 'navbar.php'; ?>

    <div class="container">
        <form method="post" class="login-form" enctype="multipart/form-data">
            <h2>Tambah Sertifikat</h2>
            <label for="judul">Judul:</label>
            <input type="text" id="judul" name="judul" required>
            <label for="keterangan">Keterangan:</label>
            <textarea id="keterangan" name="keterangan" required></textarea>
            <label for="tanggal_diterima">Tanggal Diterima:</label>
            <input type="date" id="tanggal_diterima" name="tanggal_diterima" required value="<?= date("Y-m-d"); ?>">
            <label for="kedaluwarsa">Dapat Kedaluwarsa?</label>
            <input type="checkbox" name="kedaluwarsa" id="kedaluwarsa" class="checkbox">
            <div style="display: none;" id="form_tanggal_kedaluwarsa">
                <label for="tanggal_kedaluwarsa">Tanggal Kedaluwarsa:</label>
                <input type="date" id="tanggal_kedaluwarsa" name="tanggal_kedaluwarsa">
            </div>
            <label for="file_sertifikat">File Sertifikat:</label>
            <input type="file" name="file_sertifikat" id="file_sertifikat" required>
            <label for="nilai">Nilai:</label>
            <input type="number" id="nilai" name="nilai" required>
            <button type="submit" name="btnTambah" class="btn">Kirim</button>
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