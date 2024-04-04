<?php
    session_start();
    require 'koneksi.php';
    require 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>RinShoes</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

<!-- Konten -->
<section class="konten">
    <div class="container mt-4">
        <h1 class="text-center">Katalog Produk</h1>
        <div class="row mt-3" >
            <?php 
            $sql = mysqli_query($koneksi, "SELECT * FROM produk");
            while ($perproduk = mysqli_fetch_assoc($sql)){ ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="thumbnail">
                    <img src="foto_produk/<?php echo $perproduk['foto_produk'];?>" alt="" width="200px" height="200px">
                    <div class="caption">
                        <h5><?php echo $perproduk['nama_produk']; ?></h5>
                        <h6>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h6>
                        <a href="beli.php?id=<?php echo $perproduk['id_produk'];?>" class="btn btn-primary me-2">Beli</a>
                        <a href="detail.php?id=<?php echo $perproduk['id_produk'];?>" class="btn btn-outline-secondary">Detail</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

</section>

<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>