<?php
// navbar.php
// Pastikan sudah include db.php & session_start() sebelum require navbar.php
$cart_qty = function_exists('cart_count') ? cart_count() : 0;
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">Chic Boutique</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link<?= basename($_SERVER['PHP_SELF'])==='index.php'?' active':'' ?>" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?= basename($_SERVER['PHP_SELF'])==='shop.php'?' active':'' ?>" href="shop.php">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?= basename($_SERVER['PHP_SELF'])==='about.php'?' active':'' ?>" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?= basename($_SERVER['PHP_SELF'])==='contact.php'?' active':'' ?>" href="contact.php">Contact</a>
        </li>

        <!-- Cart -->
        <li class="nav-item ms-lg-2">
          <a class="nav-link position-relative<?= basename($_SERVER['PHP_SELF'])==='cart.php'?' active':'' ?>" href="cart.php">
            <i class="bi bi-bag"></i> Cart
            <?php if ($cart_qty > 0): ?>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?= $cart_qty ?>
              </span>
            <?php endif; ?>
          </a>
        </li>

        <!-- Jika user login -->
        <?php if (!empty($_SESSION['user'])): ?>
          <li class="nav-item">
            <a class="nav-link<?= basename($_SERVER['PHP_SELF'])==='orders.php'?' active':'' ?>" href="orders.php">Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link<?= basename($_SERVER['PHP_SELF'])==='login.php'?' active':'' ?>" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link<?= basename($_SERVER['PHP_SELF'])==='register.php'?' active':'' ?>" href="register.php">Register</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
