<?php 
    session_start();
    require 'koneksi.php';
    require 'navbar.php';

    $id_produk = $_GET["id"];

    $sql = mysqli_query($koneksi,"SELECT * FROM produk WHERE id_produk = '$id_produk'");
    $detail = mysqli_fetch_assoc($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
<section class="konten">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-4 product-image">
                <img src="foto_produk/<?php echo $detail["foto_produk"];?>" alt="" class="img-fluid">
            </div>
            <div class="col-md-6 mt-4 product-description">
                <h2><strong><?php echo $detail["nama_produk"];?></strong></h2>
                <h4>Rp. <?php echo number_format($detail["harga_produk"]);?></h4>
                <h5> Stok : <?php echo $detail['stok_produk'];?></h5>
                <p><?php echo nl2br($detail["deskripsi_produk"]);?></p>
                <form method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="number" min="1" class="form-control" name="jumlah" max="<?php echo $detail['stok_produk'];?>>
                            <div class="input-group-btn">
                                <button class="btn btn-primary" name="beli">Beli</button>
                            </div>
                        </div>
                    </div>
                </form>

                <?php 
                if(isset($_POST["beli"]))
                {
                    $jumlah = $_POST["jumlah"];
                    $_SESSION["keranjang"]["$id_produk"] = $jumlah;

                    echo "<script>alert('Produk telah masuk ke keranjang');</script>";
                    echo "<script>location='keranjang.php';</script>";
                }
                ?>
                
            </div>
        </div>
    </div>

</section>


<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>