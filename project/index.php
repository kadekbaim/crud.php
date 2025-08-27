<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chic Boutique - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .hero {
      background-image: url('../img/img1.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      color: #fff;
      min-height: 100vh;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }
    .hero:after {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(0,0,0,.45);
    }
    .hero .content {
      position: relative;
      z-index: 1;
    }
  </style>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<!-- HERO SECTION -->
<section class="hero">
  <div class="content">
    <h1 class="display-4 fw-bold">Elevate Your Style</h1>
    <p class="lead">Discover the perfect pieces to complete your wardrobe</p>
    <a href="shop.php" class="btn btn-light btn-lg shadow-sm">Shop Now</a>
  </div>
</section>

<!-- Our Collection Section -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-5">Our Collection</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">

      <!-- Produk 1 -->
      <div class="col">
        <div class="card h-100 shadow-sm">
          <img src="../img/img3.png" class="card-img-top" alt="Produk 1">
          <div class="card-body text-center">
            <h5 class="card-title">long pants</h5>
            <p class="card-text text-muted">Rp 450.000</p>
            <a href="cart.php?id=1" class="btn btn-dark">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </a>
          </div>
        </div>
      </div>

      <!-- Produk 2 -->
      <div class="col">
        <div class="card h-100 shadow-sm">
          <img src="../img/img4.png" class="card-img-top" alt="Produk 2">
          <div class="card-body text-center">
            <h5 class="card-title">jacket</h5>
            <p class="card-text text-muted">Rp 200.000</p>
            <a href="cart.php?id=1" class="btn btn-dark">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </a>
          </div>
        </div>
      </div>

      <!-- Produk 3 -->
      <div class="col">
        <div class="card h-100 shadow-sm">
          <img src="../img/img9.png" class="card-img-top" alt="Produk 3">
          <div class="card-body text-center">
            <h5 class="card-title">Hoodie Casual</h5>
            <p class="card-text text-muted">Rp 300.000</p>
            <a href="cart.php?id=1" class="btn btn-dark">
              <i class="bi bi-cart-plus"></i> Add to Cart
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
