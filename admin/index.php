<?php
  session_start();

  if (!isset($_SESSION['admin'])) 
  {
    echo "<script>location='login.php';</script>";
    header('Location: login.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>RinShoes</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>

<div class="header-and-sidebar">
    <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
        <i class="bi bi-list toggle-sidebar-btn"></i>
        <a href="index.php?halaman=dashboard" class="logo d-flex align-items-center">
          <img src="../assets/img/logo.png" alt="logo" class="ms-2">
          <span class="d-none d-lg-block">RinShoes</span>
        </a>
      </div>
      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
          <li class="nav-item d-block d-lg-none">
            <a class="nav-link nav-icon search-bar-toggle" href="#">
              <i class="bi bi-search"></i>
            </a>
          </li>
          <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <img src="../assets/img/profile-admin.jpg" alt="Profile" class="rounded-circle">
              <span class="d-none d-md-block dropdown-toggle ps-2">Admin</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li>
                <a class="dropdown-item d-flex align-items-center" href="logout.php">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Sign Out</span>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </header>
  </div>

    <aside id="sidebar" class="sidebar">
      <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php?halaman=dashboard">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php?halaman=produk">
            <i class="bi bi-box-seam"></i>
            <span>Produk</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php?halaman=pelanggan">
            <i class="bi bi-people"></i>
            <span>Pelanggan</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="index.php?halaman=pembelian">
            <i class="bi bi-receipt"></i>
            <span>Pembelian</span>
          </a>
        </li>
      </ul>
    </aside>

    <div id="page-wrapper" >
        <div id="page-inner">
          <?php
              if (isset($_GET['halaman']))
              {
                if ($_GET['halaman'] =='dashboard')
                {
                  include ('dashboard.php');
                }
                elseif($_GET['halaman']=="produk")
                {
                  include 'produk.php';
                }
                elseif ($_GET['halaman']=="pembelian")
                {
                  include 'pembelian.php';
                }
                elseif ($_GET['halaman']=="pelanggan")
                {
                  include 'pelanggan.php';
                }
                elseif ($_GET['halaman']=="detail")
                {
                  include "detail.php";
                }
                elseif ($_GET['halaman']=="tambahproduk")
                {
                  include "tambahproduk.php";
                }
                elseif ($_GET['halaman']== "hapusproduk")
                {
                  include "hapusproduk.php";
                }
                elseif ($_GET['halaman']== "ubahproduk")
                {
                  include "ubahproduk.php";
                }
                elseif ($_GET['halaman']== "logout")
                {
                  include "logout.php";
                }
                elseif ($_GET["halaman"]== "pembayaran")
                {
                  include "pembayaran.php";
                }
              }
              else
              {
                include 'dashboard.php';
              }
              ?>
          </div>
      </div>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/main.js"></script>

</body>

</html>