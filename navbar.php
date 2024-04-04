<nav class="navbar navbar-expand-lg" style="background-color: #d9d9e3;">
    <div class="container">
        <ul class="nav navbar-nav mr-auto">
            <li class="nav-item me-3"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item me-3"><a class="nav-link" href="keranjang.php">Keranjang</a></li>
            <li class="nav-item me-3"><a class="nav-link" href="checkout.php">Checkout</a></li>
        <!-- Jika sudah login (udah ada session) -->
        <?php if (isset($_SESSION["pelanggan"])): ?>
          <li class="nav-item me-3"><a class="nav-link" href="riwayat.php">Riwayat Belanja</a></li>
        <?php endif; ?>
        </ul>
        <ul class="nav navbar-nav ml-auto"> <!-- Menggunakan ml-auto untuk memindahkan ke kanan -->
        <!-- Jika sudah login (udah ada session) -->
        <?php if (isset($_SESSION["pelanggan"])): ?>
            <li class="nav-item me-3"><a class="nav-link" href="logout.php">Logout</a></li>
        <!-- Jika belum login (belum ada session) -->
        <?php else: ?>
            <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Login
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="login.php">Pembeli</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="admin/login.php">Admin</a></li>
            </ul>
            </div>
        <?php endif; ?>
        </ul>
    </div>
</nav>
