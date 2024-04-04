<?php
    require "../koneksi.php";
?>    

<link href="../assets/css/style.css" rel="stylesheet">

<?php
    $sql = mysqli_query($koneksi,"SELECT * FROM produk WHERE id_produk='$_GET[id]'");
    $pecah = mysqli_fetch_assoc($sql);
?>

<div class="container">
    <div class="row justify-content-center title-container"> 
        <h2 class="text-center">Ubah Produk</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group mt-2">
                    <label>Nama Produk</label>
                    <input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_produk'];?>">
                </div>
                <div class="form-group mt-2">
                    <label>Harga Produk</label>
                    <input type="number" name="harga" class="form-control" value="<?php echo $pecah['harga_produk'];?>">
                </div>
                <div class="form-group mt-2">
                    <img src="../foto_produk/<?php echo $pecah['foto_produk'] ?>" width="200">
                </div>
                <div class="form-group mt-2">
                    <label>Ganti Foto</label>
                    <input type="file" name="foto" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label>Stok Produk</label>
                    <input type="number" name="stok" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="10"><?php echo $pecah['deskripsi_produk'];?></textarea>
                </div>
                <button class="btn btn-primary mt-2" name="ubah">Ubah</button>
            </form>
        </div>
    </div>
</div>

<?php
    if (isset($_POST['ubah'] )) {
        $namafoto = $_FILES['foto']['name'];
        $lokasifoto = $_FILES['foto']['tmp_name'];
        // Jika foto diubah
        if (!empty($lokasifoto))
        {
            move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");

            $sql = mysqli_query($koneksi,"UPDATE produk SET nama_produk = '$_POST[nama]',
                harga_produk='$_POST[harga]', foto_produk = '$namafoto',  stok_produk='$_POST[stok]',
                deskripsi_produk='$_POST[deskripsi]' WHERE id_produk = '$_GET[id]'");
        }
        else{
            $sql = mysqli_query($koneksi,"UPDATE produk SET nama_produk = '$_POST[nama]',
            harga_produk='$_POST[harga]', stok_produk='$_POST[stok]', deskripsi_produk='$_POST[deskripsi]' 
            WHERE id_produk = '$_GET[id]'");
        }
        echo "<script>alert('Data produk telah diubah');</script>";
        echo "<script>location='index.php?halaman=produk';</script>";
    }   
?>