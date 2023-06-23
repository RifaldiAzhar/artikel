<?php
include_once("../../config.php");
include('session.php');

// Display selected user data based on id
// Getting id from url
$id = @$_GET['id'];

// Fetech user data based on id
$result = mysqli_query($mysqli, "SELECT * FROM tb_users WHERE id=$id");

while ($user_data = mysqli_fetch_array($result)) {
    $row_username = $user_data['username'];
    $row_nama_operator = $user_data['nama_operator'];
}
?>
<?php
// include config connection file
// Check if form is submitted for user update, then redirect to homepage after update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = @$_POST['username'];
    $password = @$_POST['password'];
    $nama_operator = @$_POST['nama_operator'];
    if ($password) {
        $result = mysqli_query($mysqli, "UPDATE tb_users SET username='$username',nama_operator='$nama_operator',password='$password' WHERE id=$id");
    } else {
        $result = mysqli_query($mysqli, "UPDATE tb_users SET username='$username',nama_operator='$nama_operator' WHERE id=$id");
    }
    // update user data

    // Redirect to homepage to display updated user in list
    header("Location:../dashboard.php?page=users");
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
        <?php include_once('../template/navbar.php'); ?>
        <?php include_once('../template/sidebar.php'); ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php include_once('content-header.php'); ?>
            <!-- /.content-header -->
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Users</h3>

                                    <div class="card-tools">
                                        <!-- This will cause the card to maximize when clicked -->
                                        <a href="../../admin?page=users" class="btn btn-info">Kembali</a>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>

                                <div class="card-body">

                                    <form action="../../admin/users/edit.php" method="post">
                                        <input type="hidden" name="id" value="<?= $id ?>">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" value="<?= $row_username ?>" name="username" required <?php if ($row_username == 'admin') { ?> readonly <?php } ?>>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_operator">Nama Operator</label>
                                            <input type="text" class="form-control" value="<?= $row_nama_operator ?>" name="nama_operator" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" value="" name="password">
                                            <span class="help-block"> Kosongkan bila tidak di ubah</span>
                                        </div>
                                        <button class="btn btn-primary" type="submit" name="update">Simpan</button>

                                    </form>


                                </div>
                                <!-- /.content-wrapper -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('../template/footer.php'); ?>

    </div>
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
                alert('Data berhasil dihapus');
            } else {
                //action cancelled
                alert('Data batal di hapus');
                return false;

            }
        }
    </script>
</body>

</html>