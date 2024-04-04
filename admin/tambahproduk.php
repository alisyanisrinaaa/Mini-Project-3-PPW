<?php
    require "../koneksi.php";
?>

<link href="../assets/css/style.css" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center title-container"> 
        <h2 class="text-center">Tambah Produk</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group mt-2">
                    <label>Nama Produk</label>
                    <input type="text" class="form-control" name="nama">
                </div>
                <div class="form-group mt-2">
                    <label>Harga (Rp)</label>
                    <input type="number" class="form-control" name="harga">
                </div>
                <div class="form-group mt-2">
                    <label>Foto Produk</label>
                    <input type="file" class="form-control" name="foto">
                </div>
                <div class="form-group mt-2">
                    <label>Stok Produk</label>
                    <input type="number" class="form-control" name="stok">
                </div>
                <div class="form-group mt-2">
                    <label>Deskripsi Produk</label>
                    <textarea class="form-control" name="deskripsi" rows="10"></textarea>
                </div>
                <button class="btn btn-primary mt-2" name="simpan">Simpan</button>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST["simpan"])) 
{
    $nama = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasi, "../foto_produk/".$nama);
    $sql = mysqli_query($koneksi, "INSERT INTO produk
        (nama_produk, harga_produk, foto_produk, deskripsi_produk, stok_produk) 
        VALUES('$_POST[nama]','$_POST[harga]', '$nama', '$_POST[deskripsi]', $_POST[stok])");

    echo "<div class='alert alert-info'>Produk tersimpan</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
}
?>