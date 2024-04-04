<?php
    require "../koneksi.php";

    $sql = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$_GET[id]'");
    $pecah = mysqli_fetch_assoc($sql);
    $fotoproduk = $pecah['foto_produk'];
    if (file_exists("../foto_produk/$fotoproduk"))
    {
        unlink("../foto_produk/$fotoproduk");
    }

    $sql = mysqli_query($koneksi,"DELETE FROM produk WHERE id_produk='$_GET[id]'");

    echo "<script>alert ('Produk terhapus');</script>";
    echo "<script>location='index.php?halaman=produk';</script>";
?>