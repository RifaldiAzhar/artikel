<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include("../../config.php");
include('session.php');

if (isset($_POST['submit'])) {
    $nama_acara = @$_POST['nama_acara'];
    $deskripsi = @$_POST['deskripsi'];
    $waktu = date("Y-m-d H:i:s", strtotime(@$_POST['waktu']));
    
    $kategori = @$_POST['kategori'];
    
    $sql = "SELECT * FROM tb_agenda WHERE nama_acara='$nama_acara'";
    $ekstensi_diperbolehkan    = array('png', 'jpg');
    $nama = $_FILES['gambar']['name'];
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $ukuran    = $_FILES['gambar']['size'];
    $file_tmp = $_FILES['gambar']['tmp_name'];
    
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if ($ukuran < 1044070) {
            $query = move_uploaded_file($file_tmp, 'uploads/' . $nama);
            $file_name = $nama;
            if ($query) {
                echo '<script> alert("FILE BERHASIL DI UPLOAD") </script>';
            } else {
                echo '<script> alert("GAGAL MENGUPLOAD GAMBAR") </script>';
            }
        } else {
            echo '<script> alert("UKURAN FILE TERLALU BESAR") </script>';
        }
    } else {
        echo '<script> alert("EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN") </script>';
    }

    $result = mysqli_query($mysqli, "INSERT INTO tb_agenda(id,nama_acara,waktu,deskripsi,kategori,gambar)
         VALUES(null,'$nama_acara','$waktu','$deskripsi','$kategori','$file_name')");
}
// 
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include('../template/navbar.php'); ?>
        <?php include('../template/sidebar.php'); ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php include('content-header.php'); ?>
            <!-- /.content-header -->
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="card">

                                <div class="card-header">
                                    <h3 class="card-title">Data agenda
                                    </h3>

                                    <div class="card-tools">
                                        <!-- This will cause the card to maximize when clicked -->
                                        <a href="<?= $base_url_admin ?>/dashboard.php?page=agenda" class="btn btn-info">Kembali</a>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <form action="../agenda/create.php?page=agenda" method="post" enctype="multipart/form-data">

                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="nama_acara">Nama acara</label>
                                            <input type="text" class="form-control" name="nama_acara" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="waktu">Waktu</label>
                                            <input type="datetime-local" class="form-control" name="waktu" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea type="text" class="form-control" name="deskripsi" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="gambar">Gambar</label>
                                            <input type="file" class="form-control" name="gambar" required>
                                        </div>
                                        <?php
                                        $kategori = mysqli_query($mysqli, "SELECT * FROM tb_kategori ORDER BY id DESC");
                                        ?>
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <select class="form-control" name="kategori" required>
                                                <option value="">Pilih Kategori</option>
                                                <?php while ($data = mysqli_fetch_array($kategori)) { ?>
                                                    <option value="<?= $data['id'] ?>"><?= $data['nama_kategori'] ?></option>
                                                <?php } ?>
                                                <select>
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->


        <?php include('../template/footer.php'); ?>

    </div>
</body>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script>
    function confirmDelete() {
        if (confirm('Anda yakin menghapus data?')) {
            //action confirmed
        } else {
            //action cancelled
            alert('Data batal di hapus');
            return false;

        }
    }
</script>
</body>

</html>