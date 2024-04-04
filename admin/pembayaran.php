<?php
    require "../koneksi.php";
?>

<link href="../assets/css/style.css" rel="stylesheet">

<?php
    $id_pembelian = $_GET['id'];

    $sql = mysqli_query($koneksi,"SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
    $detail = mysqli_fetch_assoc($sql);
?>

<div class="container">
    <div class="row justify-content-center title-container"> 
        <h2 class="text-center">Data Pembayaran</h2>
        <div class="row justify-content-center mt-2">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <td><?php echo $detail['nama']?></td>
                    </tr>
                    <tr>
                        <th>Bank</th>
                        <td><?php echo $detail['bank']?></td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>Rp. <?php echo number_format($detail['jumlah'])?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td><?php echo $detail['tanggal']?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-2 justify-content-center">
                <img src="../bukti_pembayaran/<?php echo $detail['bukti_pembayaran']?>" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</div>  