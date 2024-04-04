<?php 
    session_start();
    require 'koneksi.php';
    require 'navbar.php';

    if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
    {
        echo "<script>alert('Silahkan login');</script>";
        echo "<script>location='login.php';</script>";
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Nota Pembelian</title>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

<section class="konten">
    <div class="container">

    <h2 class="text-center title-container">Nota Pembelian</h2>

<?php
    // Periksa apakah parameter id tersedia
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        // Ambil id pembelian dari parameter
        $id_pembelian = $_GET['id'];
        
        // Query untuk mendapatkan detail pembelian berdasarkan id_pembelian
        $sql = mysqli_query($koneksi, "SELECT * FROM pembelian JOIN pelanggan
            ON pembelian.id_pelanggan = pelanggan.id_pelanggan
            WHERE pembelian.id_pembelian = '$id_pembelian'");
        $detail = mysqli_fetch_assoc($sql);
?>

<?php
// Mendapatkan id pelanggan yang beli
$idpelangganygbeli = $detail["id_pelanggan"];

//Mendapatkan id pelanggan yang login
$idpelangganyglogin = $_SESSION["pelanggan"]["id_pelanggan"];

if($idpelangganygbeli !== $idpelangganyglogin) 
{
    echo "<script>alert ('Jangan nakal');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 mt-4">
            <div class="row">
                <div class="col-md-4">
                    <h3>Pembelian</h3>
                    <strong>No. Pembelian : <?php echo $detail['id_pembelian'];?></strong><br>
                    Tanggal : <?php echo $detail['tanggal_pembelian'];?> <br>
                    Total: <?php echo $detail['total_pembelian'];?>
                </div>
                <div class="col-md-4">
                    <h3>Pelanggan</h3>
                    <strong><?php echo $detail['nama_pelanggan'];?></strong> <br>
                    <p>
                        <?php echo $detail['nohp_pelanggan'];?> <br>
                        <?php echo $detail['email_pelanggan'];?>
                    </p>
                </div>
                <div class="col-md-4">
                    <h3>Pengiriman</h3>
                    <strong><?php echo $detail['nama_kota'];?></strong><br>
                    Ongkos Kirim : Rp. <?php echo number_format($detail['tarif']); ?><br>
                    Alamat : <?php echo $detail['alamat_pengiriman'];?>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Nama Produk</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $nomor=1;
                        // Query untuk mendapatkan produk yang dibeli dalam pembelian ini
                        $sql_produk = mysqli_query($koneksi, "SELECT * FROM pembelian_produk WHERE id_pembelian ='$_GET[id]'");
                        while ($pecah = mysqli_fetch_assoc($sql_produk)) {
                    ?>
                    <tr class="text-center">
                        <td><?php echo $nomor;?></</td>
                        <td><?php echo $pecah['nama'];?></td>
                        <td>Rp. <?php echo number_format($pecah["harga"]);?></td>
                        <td><?php echo $pecah['jumlah'];?></td>
                        <td>Rp. 
                            <?php echo number_format($pecah["subharga"]);?>
                        </td>
                    </tr>
                    <?php $nomor++ ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
    }
?>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="alert alert-info">
            Silahkan melakukan pembayaran sebesar Rp. <?php echo number_format($detail['total_pembelian']);
            ?> ke <br>
            <strong>BANK BRI 010-029302-9343 AN. Nisrina </strong>
        </div>
    </div>
</div>
    </div>
</section>

<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>