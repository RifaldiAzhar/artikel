<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include("../../config.php");
include('session.php');

if (isset($_POST['submit'])) {
    $nama_kategori = @$_POST['nama_kategori'];
    $sql = "SELECT * FROM tb_kategori WHERE nama_kategori='$nama_kategori'";
    $result = mysqli_query($mysqli, $sql);
    if ($result->num_rows > 0) {
        echo "<script>alert('Nama Kategori sudah ada. Silahkan coba lagi!')</script>";
    } else {
        $result = mysqli_query($mysqli, "INSERT INTO tb_kategori(nama_kategori) VALUES('$nama_kategori')");
    }
}
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
                                    <h3 class="card-title">Data Kategori
                                    </h3>

                                    <div class="card-tools">
                                        <!-- This will cause the card to maximize when clicked -->
                                        <a href="<?= $base_url_admin ?>/dashboard.php?page=kategori" class="btn btn-info">Kembali</a>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <form action="../kategori/create.php?page=kategori" method="post" name="form1">

                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="nama_kategori">Nama Kategori</label>
                                            <input type="text" class="form-control" name="nama_kategori" required>
                                        </div>
                                        <!-- /.content -->

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