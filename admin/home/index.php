<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include("../config.php");
include('session.php');

$kategori = mysqli_query($mysqli, 'SELECT count(*) jml FROM tb_kategori');
$row_kategori = mysqli_fetch_assoc($kategori);
$artikel = mysqli_query($mysqli, 'SELECT count(*) jml FROM tb_artikel');
$row_artikel = mysqli_fetch_assoc($artikel);
$users = mysqli_query($mysqli, 'SELECT count(*) jml FROM tb_users');
$row_users = mysqli_fetch_assoc($users);
$menu = mysqli_query($mysqli, 'SELECT count(*) jml FROM tb_menu');
$row_menu = mysqli_fetch_assoc($menu);
?>
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">

                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $row_users['jml'] ?></h3>
                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $row_artikel['jml'] ?><sup style="font-size: 20px"></sup></h3>
                        <p>Artikel</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-pen"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>
                            <?= $row_kategori['jml'] ?>
                        </h3>
                        <p>Kategori</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>
                            <?= $row_menu['jml'] ?>
                        </h3>
                        <p>Menu</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-th"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>