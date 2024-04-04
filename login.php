<?php
  session_start();
  require 'koneksi.php';
  require 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login Pelanggan</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

<div class="container">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
            <div class="d-flex justify-content-center py-3">
              <a href="" class="logo d-flex align-items-center w-auto">
                <img src="../assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">RinShoes</span>
              </a>
            </div>

            <div class="card mb-3">
              <div class="card-body">
                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                  <p class="text-center small">Masukkan Email dan Password</p>
                </div>

                <form class="row g-3 needs-validation" novalidate method="post">
                  <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="text" name="email" class="form-control" required>
                      <div class="invalid-feedback">Masukkan Email Anda.</div>
                    </div>
                  </div>

                    <div class="col-12">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" required>
                      <div class="invalid-feedback">Masukkan Password Anda!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Ingat saya</label>
                      </div>
                    </div>
                    <div class="col-12">
                        <p class="small mb-0">Tidak memiliki akun? <a href="register.php">Buat akun</a></p>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100 mt-1" name="login">Login</button>
                    </div>
                  </form>

                  <?php
                    if (isset($_POST["login"]))
                    {
                        $email = $_POST["email"];
                        $password = $_POST["password"];
                        $sql = mysqli_query($koneksi, "SELECT * FROM pelanggan 
                            WHERE email_pelanggan = '$email' AND password_pelanggan = '$password'");
                        $countdata = mysqli_num_rows($sql);

                        if ($countdata == 1)
                        {
                          $akun = mysqli_fetch_assoc($sql);
                          $_SESSION["pelanggan"] = $akun;
                          echo "<script>alert('Anda berhasil login');</script>";
                          
                          if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
                          {
                            echo "<script>location='checkout.php';</script>";
                          }
                          else
                          {
                            echo "<script>location='riwayat.php';</script>";
                          }
                          
                        }
                        else
                        {
                          echo "<script>alert('Anda gagal login, periksa email atau password anda');</script>";
                          echo "<script>location='login.php';</script>";
                        }
                    }
                  ?>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>


</body>
</html>