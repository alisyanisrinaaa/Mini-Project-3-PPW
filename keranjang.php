<?php
    session_start();
    require 'koneksi.php';
    require 'navbar.php';
    
    if(empty($_SESSION["keranjang"]) OR !isset( $_SESSION["keranjang"]))
    {
        echo "<script>alert('Keranjang kosong, silahkan berbelanja');</script>";
        echo "<script>location='index.php';</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Keranjang Belanja</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<section class="konten">
    <div class="container">
        <h1 class="text-center mt-3">Keranjang Belanja</h1>
        <hr>
        <table class="table table-bordered">
            <thead class="text-center">
                <tr>
                    <th>No.</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subharga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php 
                $nomor=1;
                if(isset($_SESSION["keranjang"]) && is_array($_SESSION["keranjang"])){
                    foreach ($_SESSION["keranjang"] as $id_produk => $jumlah){
                        $SQL = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk'");
                        $pecah = mysqli_fetch_assoc($SQL);
                        $subharga = $pecah["harga_produk"] * $jumlah;
                ?>
                <tr>
                    <td><?php echo $nomor;?></td>
                    <td><?php echo $pecah["nama_produk"];?></td>
                    <td>Rp. <?php echo number_format($pecah["harga_produk"]);?></td>
                    <td><?php echo $jumlah;?></td>                        
                    <td>Rp. <?php echo number_format($subharga);?></td>
                    <td>
                        <a href="hapuskeranjang.php?id=<?php echo $id_produk?>" class="btn btn-danger btn-xs">Hapus</a>
                    </td>
                </tr>
                <?php 
                    $nomor++;
                    }
                } 
                ?>
            </tbody>
        </table>

        <a href="index.php" class="btn btn-outline-secondary me-2">Lanjutkan Belanja</a>
        <a href="checkout.php" class="btn btn-primary">Checkout</a>
    </div>
</section>


<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>