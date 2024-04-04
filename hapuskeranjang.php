<?php 
    session_start();
    require 'koneksi.php';

    $id_produk = $_GET["id"];

    if (isset($_SESSION["keranjang"][$id_produk])){
        if($_SESSION["keranjang"][$id_produk] > 1) {
            // Kurangi jumlah item yang dihapus dari keranjang
            $_SESSION["keranjang"][$id_produk] -= 1;
        } else {
            // Jika jumlah produk hanya 1, hapus item dari keranjang
            unset($_SESSION["keranjang"][$id_produk]);
        }($_SESSION["keranjang"][$id_produk]);
    }
    
    echo "<script>alert('Produk telah dihapus dari keranjang');</script>";
    echo "<script>location='keranjang.php';</script>";

?>