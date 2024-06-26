<?php
    session_start();
    require 'koneksi.php';
    require 'navbar.php';

    if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
    {
        echo "<script>alert('Silahkan login');</script>";
        echo "<script>location='login.php';</script>";
        exit();
    }

    // ID pelanggan dari url
    $idpem = $_GET["id"];
    $sql = mysqli_query($koneksi, "SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
    $detpem = mysqli_fetch_assoc($sql);

    // ID pelanggan yang beli
    $id_pelanggan_beli = $detpem["id_pelanggan"];

    //ID pelanggan yang login

    $id_pelanggan_beli = $detpem["id_pelanggan"];
    $id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

    if ($id_pelanggan_login !== $id_pelanggan_beli)
    {
        echo "<script>alert('Jangan nakal');</script>";
        echo "<script>location='riwayat.php';</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Konfirmasi Pembayaran</h2>
    <p>Kirim bukti pembayaran Anda disini</p>
    <div class="alert alert-info">Total Tagihan Anda <strong>Rp. <?php echo number_format($detpem["total_pembelian"])?></strong></div>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama Penyetor</label>
            <input type="text" class="form-control" name="nama">
        </div>
        <div class="form-group mt-2">
            <label>Bank</label>
            <input type="text" class="form-control" name="bank">
        </div>
        <div class="form-group mt-2">
            <label>Jumlah</label>
            <input type="number" class="form-control" name="jumlah" min="1">
        </div>
        <div class="form-group mt-2">
            <label>Bukti Foto</label>
            <input type="file" class="form-control" name="bukti">
            <p class="text-danger">Foto bukti maksimal 2 MB.</p>
        </div>
        <button class= "btn btn-primary" name="kirim">Kirim</button>
    </form>
</div>

<?php

if (isset($_POST["kirim"]))
{
    $namabukti = $_FILES["bukti"]["name"];
    $lokasibukti = $_FILES["bukti"]["tmp_name"];
    $namafiks = date("YmdHis").$namabukti;
    move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

    $nama = $_POST["nama"];
    $bank = $_POST["bank"];
    $jumlah = $_POST["jumlah"];
    $tanggal = date("Y-m-d");

    $sql = mysqli_query($koneksi,"INSERT INTO pembayaran(id_pembelian, nama, bank, jumlah, tanggal, bukti_pembayaran)
        VALUES ('$idpem', '$nama', '$bank', '$jumlah', '$tanggal', '$namafiks')");

    $sql = mysqli_query($koneksi,"UPDATE pembelian SET status_pembelian='Sudah bayar'
        WHERE id_pembelian='$idpem'");

    echo "<script>alert('Terima kasih sudah mengirimkan bukti pembayaran');</script>";
    echo "<script>location='riwayat.php';</script>";
}

?>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>