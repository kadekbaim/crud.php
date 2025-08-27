<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>About - Chic Boutique</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<section class="bg-light text-center p-5">
  <h1 class="fw-bold">About Chic Boutique</h1>
  <p class="lead">Redefining fashion with elegance and sophistication</p>
</section>

<section class="py-5">
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-md-6">
        <img src="../img/about.png" class="img-fluid rounded shadow" alt="About">
      </div>
      <div class="col-md-6">
        <h2 class="fw-bold">Our Story</h2>
        <p>Chic Boutique lahir dari kecintaan pada fashion yang timeless—mewah, nyaman, dan elegan. Kami kurasi koleksi terbaik untuk menonjolkan kepribadianmu setiap hari.</p>
        <a href="shop.php" class="btn btn-dark mt-3">Shop Now</a>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body></html>
