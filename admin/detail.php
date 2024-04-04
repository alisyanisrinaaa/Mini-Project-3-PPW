<?php
    require "../koneksi.php";
?>

<link href="../assets/css/style.css" rel="stylesheet">

<h2 class="text-center title-container">Detail Pembelian</h2>

<?php
    // Periksa apakah parameter id tersedia
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        // Ambil id pembelian dari parameter
        $id_pembelian = $_GET['id'];
        
        // Query untuk mendapatkan detail pembelian berdasarkan id_pembelian
        $sql = mysqli_query($koneksi, "SELECT * FROM pembelian JOIN pelanggan
            ON pembelian.id_pelanggan = pelanggan.id_pelanggan
            WHERE pembelian.id_pembelian = '$id_pembelian'");
        $detail = mysqli_fetch_assoc($sql);

        // Cek apakah pembelian ditemukan
        if($detail) {
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <strong><?php echo $detail['nama_pelanggan'];?></strong> <br>
            <p>
                <?php echo $detail['nohp_pelanggan'];?> <br>
                <?php echo $detail['email_pelanggan'];?>
            </p>

            <p>
                Tanggal : <?php echo $detail['tanggal_pembelian'];?> <br>
                Total: <?php echo $detail['total_pembelian'];?>   
            </p>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Nama Produk</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $nomor=1;
                        // Query untuk mendapatkan produk yang dibeli dalam pembelian ini
                        $sql_produk = mysqli_query($koneksi, "SELECT * FROM pembelian_produk JOIN produk 
                            ON pembelian_produk.id_produk = produk.id_produk 
                            WHERE pembelian_produk.id_pembelian ='$id_pembelian'");
                        while ($pecah = mysqli_fetch_assoc($sql_produk)) {
                    ?>
                    <tr class="text-center">
                        <td><?php echo $nomor;?></</td>
                        <td><?php echo $pecah['nama_produk'];?></td>
                        <td>Rp. <?php echo number_format ($pecah['harga_produk']);?></td>
                        <td><?php echo $pecah['jumlah'];?></td>
                        <td>Rp. 
                            <?php echo number_format($pecah['harga_produk']*$pecah['jumlah']);?>
                        </td>
                    </tr>
                    <?php $nomor++ ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
        } else {
            echo "<p class='text-center'>Pembelian tidak ditemukan.</p>";
        }
    } else {
        echo "<p class='text-center'>Parameter id_pembelian tidak ditemukan.</p>";
    }
?>