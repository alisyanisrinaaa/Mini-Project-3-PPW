<?php
    require "../koneksi.php";
?>

<link href="../assets/css/style.css" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center title-container"> 
        <h2 class="text-center">Data Pembelian</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Nama Pelanggan</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Status Pembelian</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $nomor=1;
                        $sql = mysqli_query($koneksi, "SELECT * FROM pembelian JOIN pelanggan ON 
                        pembelian.id_pelanggan=pelanggan.id_pelanggan");
                        while ($pecah = mysqli_fetch_assoc($sql)) {
                    ?>
                    <tr class="text-center">
                        <td><?php echo $nomor;?></</td>
                        <td><?php echo $pecah['nama_pelanggan'];?></td>
                        <td><?php echo $pecah['tanggal_pembelian'];?></td>
                        <td><?php echo $pecah['status_pembelian'];?></td>
                        <td>Rp. <?php echo number_format( $pecah['total_pembelian']);?></td>
                        <td>
                            <a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian'];?>" class="btn btn-info me-2">Detail</a>

                            <?php if ($pecah['status_pembelian'] == "Sudah bayar"): ?>
                            <a href="index.php?halaman=pembayaran&id=<?php echo $pecah['id_pembelian'];?>" class="btn btn-success">Pembayaran</a>
                            <?php endif ?>
                    </tr>
                    <?php $nomor++ ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

