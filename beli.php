<?php
session_start();

// Mendapatkan id_produk dari url
$id_produk = $_GET['id'];

// Jika sudah ada produk itu dikeranjang, maka produk itu jumlahnya akan +1
if(isset($_SESSION['keranjang'][$id_produk]))
{
    $_SESSION['keranjang'][$id_produk] +=1;
}
// Jika produk belum ada di keranjang, produk itu dianggap dibeli 1
else
{
    $_SESSION['keranjang'][$id_produk] = 1;
}

// Ke halaman keranjang
echo "<script>alert('Produk telah masuk ke keranjang');</script>";
echo "<script>location='keranjang.php';</script>";

?>