<?php
  session_start();
  require '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login Admin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="../assets/img/favicon.png" rel="icon" >
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
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
                  <p class="text-center small">Masukkan Username dan Password</p>
                </div>

                <form class="row g-3 needs-validation" novalidate method="post">
                  <div class="col-12">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="text" name="user" class="form-control" required>
                      <div class="invalid-feedback">Masukkan Username Anda.</div>
                    </div>
                  </div>

                    <div class="col-12">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="pass" class="form-control" required>
                      <div class="invalid-feedback">Masukkan Password Anda!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Ingat saya</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100 mt-1" name="login">Login</button>
                    </div>
                  </form>

                  <?php
                    if(isset($_POST['login'])){
                      $sql = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$_POST[user]' 
                        AND password='$_POST[pass]'");
                      $countdata = mysqli_num_rows($sql);

                      if($countdata==1){
                        $_SESSION['admin'] = mysqli_num_rows($sql);
                        echo "<div class='alert alert-info mt-2'>Login sukses</div>";
                        echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                      }
                      else{
                        echo "<div class='alert alert-danger mt-2'>Username atau password anda salah</div>";
                        echo "<meta http-equiv='refresh' content='1;url=login.php'>";
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

<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/main.js"></script>

</body>
</html>