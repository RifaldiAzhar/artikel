<?php
include_once("../config.php");

?>
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data agenda</h3>

                        <div class="card-tools">
                            <!-- This will cause the card to maximize when clicked -->
                            <a href='agenda/create.php?page=agenda' class="btn btn-info"><i class="fas fa-plus"></i>Tambah agenda</a>
                        </div>
                        <!-- /.card-tools -->
                    </div>

                    <div class="card-body">

                        <table width='100%' id='tabel-simpel' class="table table-bordered">

                            <tr>
                                <th>No</th>
                                <th>Nama Agenda</th>
                                <th>Kategori Agenda</th>
                                <th>Waktu</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            $no = 1;
                            $result = mysqli_query($mysqli, "SELECT tb_agenda.*, tb_kategori.id kategori_id, tb_kategori.nama_kategori
                            FROM tb_agenda
                            INNER JOIN tb_kategori ON tb_agenda.kategori = tb_kategori.id
                            ORDER BY id DESC");

                            while ($data = mysqli_fetch_array($result)) {
                            ?>

                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $data['nama_acara'] ?></td>
                                    <td><?= $data['nama_kategori'] ?></td>
                                    <td><?= $data['waktu'] ?></td>
                                    <td><?= $data['deskripsi'] ?></td>
                                    <td>
                                        <a class="btn btn-success" href='agenda/edit.php?id=<?= $data['id'] ?>&page=agenda'>Edit</a>
                                        <a class="btn btn-danger" onclick='return confirmDelete()' href='agenda/delete.php?id=<?= $data['id'] ?>&page=agenda'>Hapus</a>
                                    </td>
                                </tr><?php } ?>
                        </table>
                    </div>
                </div><!-- /.card -->
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>