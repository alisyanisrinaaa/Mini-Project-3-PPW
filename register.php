<?php
  require 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register Pelanggan</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">RinShoes</span>
                </a>
              </div>

              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Buat Akun</h5>
                    <p class="text-center small">Masukkan detail pribadi Anda untuk membuat akun</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate method="post">
                    <div class="col-12">
                      <label for="nama" class="form-label">Nama</label>
                      <input type="text" name="nama" class="form-control" required>
                      <div class="invalid-feedback">Masukkan nama Anda!</div>
                    </div>

                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <input type="text" name="email" class="form-control" required>
                      <div class="invalid-feedback">Silahkan isi alamat email</div>
                    </div>

                    <div class="col-12">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control"required>
                      <div class="invalid-feedback">Masukkan password Anda!</div>
                    </div>

                    <div class="col-12">
                      <label for="telepon" class="form-label">Telp/HP</label>
                      <input type="telepon" name="telepon" class="form-control" required>
                      <div class="invalid-feedback">Masukkan Nomor Telp/HP Anda!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">Dengan masuk, saya setuju dengan <a href="#">Syarat & Ketentuan</a></label>
                        <div class="invalid-feedback">Anda harus menyetujuinya sebelum mengirimkan.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="submit">Buat Akun</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Sudah punya akun? <a href="login.php">Login</a></p>
                    </div>
                  </form>

                  <?php
                  if (isset($_POST["submit"])) 
                  {
                    $nama = $_POST["nama"];
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    $telepon = $_POST["telepon"];

                    $sql = mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE email_pelanggan = '$email'");
                    $cocok = mysqli_num_rows($sql);
                    if ($cocok == 1)
                    {
                      echo "<script>alert('Pendaftaran gagal, email sudah digunakan');</script>";
                      echo "<scrip>location='register.php';</scrip>";
                    }
                    else 
                    {
                      $koneksi -> query("INSERT INTO pelanggan
                        (email_pelanggan, password_pelanggan, nama_pelanggan, nohp_pelanggan)
                        VALUES ('$email', '$password', '$nama', '$telepon')");

                        echo "<script>alert('Pendaftaran berhasil, silahkan login');</script>";
                        echo "<script>location='login.php';</script>";
                    }
                  }
                  
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>

      </section>

    </div>
  </main>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>

</body>

</html>