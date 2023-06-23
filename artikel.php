<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include("config.php");

if($_GET['id']) {
  $id = $_GET['id'];
  $artikel = mysqli_query($mysqli, "SELECT tb_artikel.*,
                              tb_kategori.nama_kategori,
                              tb_users.nama_operator
                              FROM tb_artikel
                              INNER JOIN tb_kategori ON tb_artikel.id_kategori = tb_kategori.id
                              INNER JOIN tb_users ON tb_artikel.user_id = tb_users.id
                              WHERE tb_artikel.id = $id
                              limit 1
                              ");
  $data = mysqli_fetch_array($artikel);
  
} else {
  header("Location: index.php");
}

$kategori = mysqli_query($mysqli, "SELECT * from tb_kategori");
$menu = mysqli_query($mysqli, "SELECT * from tb_menu");
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.101.0">
  <title>Blog Website</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/blog/">



  <!-- Bootstrap core CSS -->
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">



  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    .jumbotron-image {
      background-position: center center;
      background-repeat: no-repeat;
      background-size: cover;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="blog.css" rel="stylesheet">
</head>

<body>

  <div class="container">
    <header class="blog-header py-3">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">
          <a class="text-muted" href="#"></a>
        </div>
        <div class="col-4 text-center">
          <a class="blog-header-logo text-dark" href="#">Farmer</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          
        </div>
      </div>
    </header>

    <div class="nav-scroller py-1 mb-2">
      <nav class="nav d-flex justify-content-between">
        <?php
        while ($data_menu = mysqli_fetch_array($menu)) {
        ?>
          <a class="p-2 text-muted" href="index.php"><?= $data_menu['nama_menu'] ?></a>
        <?php } ?>
      </nav>
    </div>
  </div>

  <main role="main" class="container">
    <div class="card rounded shadow">
      <div class="card-body">
        <div class="row">
          <div class="col p-4 d-flex flex-column position-static">
            <img width="50%%" class="rounded mx-auto" src="admin/artikel/image/<?= $data['cover'] ?>" alt="">
            <strong class="d-inline-block mb-2 text-primary"><?= $data['nama_kategori'] ?></strong>
            <h3 class="mb-0"><?= $data['judul_artikel']?></h3>
            <div class="mb-1 text-muted"><?= date('d-M-Y', strtotime($data['created_time'])) ?></div>
            <p class="card-text mb-auto text-justify"><?= $data['content_artikel']?></p>
          </div>
        </div>
      </div>
    </div>
  </main><!-- /.container -->

  <footer class="blog-footer">
    <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
    <p>
      <a href="#">Back to top</a>
    </p>
  </footer>



</body>

</html>