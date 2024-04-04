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
  <title>Riwayat Pembelian</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
   
<section class="riwayat">
    <div class="container mt-2">
        <h3>Riwayat Belanja <?php echo $_SESSION["pelanggan"]["nama_pelanggan"]?></h3>

        <table class="table table-bordered">
            <thead class="text-center">
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php 
                $nomor=1;
                $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                $sql = mysqli_query($koneksi, "SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");
                while ($pecah = mysqli_fetch_assoc($sql)){                
                ?>
                <tr>
                    <td><?php echo $nomor;?></td>
                    <td><?php echo $pecah["tanggal_pembelian"]?></td>
                    <td><?php echo $pecah["status_pembelian"]?></td>
                    <td>Rp. <?php echo number_format($pecah["total_pembelian"])?></td>
                    <td>
                        <a href="nota.php?id=<?php echo $pecah["id_pembelian"]?>" class="btn btn-info">Nota</a>

                        <?php if ($pecah['status_pembelian'] == "Pending"):?>
                        <a href="pembayaran.php?id=<?php echo $pecah ["id_pembelian"];?>" class="btn btn-success">Input Pembayaran</a>

                        <?php else: ?>
                        <a href="lihat_pembayaran.php?id=<?php echo $pecah ["id_pembelian"];?>" class="btn btn-warning">Lihat Pembayaran</a>

                        <?php endif ?>
                    </td>
                </tr>
                <?php $nomor++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>