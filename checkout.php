<?php
    session_start();
    require 'koneksi.php';
    require 'navbar.php';

    if (!isset($_SESSION["pelanggan"]))
    {
        echo "<script>alert('Silahkan login terlebih dahulu');</script>";
        echo "<script>location='login.php';</script>";
    }
    if (!isset($_SESSION["keranjang"])) {
        $_SESSION["keranjang"] = array();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Checkout</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

<section class="konten">
    <div class="container">
        <h1 class="text-center mt-3">Checkout Belanja</h1>
        <hr>
        <table class="table table-bordered">
            <thead class="text-center">
                <tr>
                    <th>No.</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subharga</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php $nomor=1;?>
                <?php $totalbelanja = 0;?>
                <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
                <?php     
                $SQL = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk'");
                $pecah = mysqli_fetch_assoc($SQL);
                $subharga = $pecah["harga_produk"] * $jumlah;
                ?>
                <tr>
                    <td><?php echo $nomor;?></td>
                    <td><?php echo $pecah["nama_produk"];?></td>
                    <td>Rp. <?php echo number_format($pecah["harga_produk"]);?></td>
                    <td><?php echo $jumlah;?></td>                        
                    <td>Rp. <?php echo number_format($subharga);?></td>
                </tr>
                <?php $nomor++; ?>
                <?php $totalbelanja+=$subharga; ?>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-center">Total Belanja</th>
                    <th class="text-center">Rp. <?php echo number_format($totalbelanja)?></th>
                </tr>
            </tfoot>
        </table>

        <form method="post">
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan']?>"
                        class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nohp_pelanggan']?>"
                        class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-control" name="id_ongkir">
                        <option value="">Pilih Ongkos Kirim</option>
                        <?php 
                        $sql = mysqli_query($koneksi, "SELECT * FROM ongkir");
                        while ($perongkir = mysqli_fetch_assoc($sql)){
                        ?>
                        <option value="<?php echo $perongkir["id_ongkir"];?>">
                            <?php echo $perongkir["nama_kota"];?>
                            Rp. <?php echo number_format($perongkir["tarif"]);?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group mt-3">
                <label>Alamat Lengkap Pengiriman</label>
                <textarea class="form-control" name="alamat_pengiriman" placeholder="Masukkan alamat lengkap pengiriman anda"></textarea>
            </div>
            <button class="btn btn-primary mt-3" name="checkout">Checkout</button>
        </form>

        <?php
        if (isset($_POST["checkout"]))
        {
            $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
            $id_ongkir = $_POST["id_ongkir"];
            $tanggal_pembelian = date("Y-m-d");
            $alamat_pengiriman = $_POST["alamat_pengiriman"];

            $sql = mysqli_query($koneksi,"SELECT * FROM ongkir wHERE id_ongkir='$id_ongkir'");
            $arrayongkir = mysqli_fetch_assoc($sql);
            $nama_kota = $arrayongkir["nama_kota"];
            $tarif = $arrayongkir['tarif'];

            $total_pembelian = $totalbelanja + $tarif;

            // Simpan data ke tabel pembelian
            $koneksi->query("INSERT INTO pembelian (
                id_pelanggan, id_ongkir, tanggal_pembelian, total_pembelian, nama_kota, tarif, alamat_pengiriman)
                VALUES ('$id_pelanggan', '$id_ongkir', '$tanggal_pembelian', '$total_pembelian', '$nama_kota', '$tarif', '$alamat_pengiriman')");

            // Mendapatkan id_pembelian baru saja terjadi
            $id_pembelian_barusan = $koneksi -> insert_id; 

            foreach ($_SESSION["keranjang"] as $id_produk => $jumlah)
            {
                // Mendapatkan data produk berdasarkan id_produk
                $sql = mysqli_query($koneksi,"SELECT * FROM produk WHERE id_produk='$id_produk'");
                $perproduk = mysqli_fetch_assoc($sql);

                $nama = $perproduk['nama_produk'];
                $harga = $perproduk['harga_produk'];
                $subharga = $perproduk['harga_produk']*$jumlah;
                $koneksi->query("INSERT INTO pembelian_produk (id_pembelian, id_produk, jumlah, nama, harga, subharga)
                    VALUES ('$id_pembelian_barusan', '$id_produk', '$jumlah', '$nama', '$harga', '$subharga')");

                $koneksi -> query("UPDATE produk SET stok_produk = stok_produk - $jumlah
                    WHERE id_produk = '$id_produk'");
            }

            // Mengkosongkan Keranjang Belanja
            unset($_SESSION["keranjang"]);

            // Tampilan dialihkan ke halaman nota
            echo "<script>alert('Pembelian sukses');</script>";
            echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
        }
        ?>
    </div>
</section>

<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>
    
</body>
</html>