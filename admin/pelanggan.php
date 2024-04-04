<?php
    require "../koneksi.php";
?>

<link href="../assets/css/style.css" rel="stylesheet">

<h2 class="text-center title-container">Data Pelanggan</h2>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Nomor Handphone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $nomor=1;
                        $sql = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                        while ($pecah = mysqli_fetch_assoc($sql)) {
                    ?>
                    <tr class="text-center">
                        <td><?php echo $nomor;?></</td>
                        <td><?php echo $pecah['nama_pelanggan'];?></td>
                        <td><?php echo $pecah['email_pelanggan'];?></td>
                        <td><?php echo $pecah['nohp_pelanggan'];?></td>
                    </tr>
                    <?php $nomor++ ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>