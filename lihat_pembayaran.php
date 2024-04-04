<?php 
    session_start();
    include 'koneksi.php';
    include 'navbar.php';

    $id_pembelian = $_GET["id"];
    $sql = mysqli_query($koneksi,"SELECT * FROM pembayaran 
    LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian 
    WHERE pembelian.id_pembelian='$id_pembelian'");
    $detbay = mysqli_fetch_assoc($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Pembayaran</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
<div class="container">
    <h1 class="mt-2">Lihat Pembayaran</h1>
    <div class="row">
        <div class="col-md-6 mt-2">
            <table class="table">
                <tr>
                    <th>Nama</th>
                    <td><?php echo $detbay["nama"] ?></td>
                </tr>
                <tr>
                    <th>Bank</th>
                    <td><?php echo $detbay["bank"] ?></</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td><?php echo $detbay["tanggal"] ?></</td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>Rp <?php echo number_format($detbay["jumlah"]) ?></td>
                </tr>

            </table>
        </div>
        <div class="col-md-2">
            <img src="bukti_pembayaran/<?php echo $detbay["bukti_pembayaran"]?>" alt="" class= "img-fluid">
        </div>
    </div>

</div>
    
</body>
</html>