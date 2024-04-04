<?php
    require "../koneksi.php";
?>

<link href="../assets/css/style.css" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center title-container"> 
        <h2 class="text-center">Data Produk</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Foto</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php 
                        $nomor=1;
                        $sql = mysqli_query($koneksi, "SELECT * FROM produk");
                        while ($pecah = mysqli_fetch_assoc($sql)) {
                    ?>
                    <tr>
                        <td><?php echo $nomor;?></td>
                        <td><?php echo $pecah['nama_produk'];?></td>
                        <td>Rp. <?php echo number_format($pecah['harga_produk']);?></td>
                        <td>
                            <img src="../foto_produk/<?php echo $pecah['foto_produk'];?>" width="200px">
                        </td>
                        <td><?php echo $pecah['stok_produk'];?></td>
                        <td>
                            <a href="index.php?halaman=ubahproduk&id=<?php echo $pecah ['id_produk'];?>" class="btn btn-warning">Ubah</a>
                            <a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk'];?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php $nomor++ ?>
                    <?php } ?>
                </tbody>
            </table>
            <a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Produk</a>
        </div>
    </div>
</div>
