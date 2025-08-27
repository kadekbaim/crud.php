<?php
include 'db.php';

// fungsi rupiah
function rupiah($angka) {
  return "Rp " . number_format($angka, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shop - E-Commerce</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container mt-5">
  <h2 class="text-center mb-4">Our Products</h2>
  <div class="row g-4">
    <?php
    $res = $conn->query("SELECT * FROM products ORDER BY id DESC");
    if ($res && $res->num_rows > 0):
      while($p = $res->fetch_assoc()): ?>
        <div class="col-md-3 col-sm-6">
          <div class="card shadow-sm border-0 h-100">
            <!-- gambar -->
            <img src="<?= htmlspecialchars($p['image']) ?>" 
                 class="card-img-top" 
                 style="height: 500 px; object-fit:cover" 
                 alt="<?= htmlspecialchars($p['name']) ?>">
            
            <div class="card-body d-flex flex-column text-center">
              <h5 class="card-title"><?= htmlspecialchars($p['name']) ?></h5>
              <p class="card-text text-muted mb-3"><?= rupiah($p['price']) ?></p>
              <!-- tombol add to cart -->
              <form action="cart.php" method="post" class="mt-auto">
                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                <input type="hidden" name="name" value="<?= htmlspecialchars($p['name']) ?>">
                <input type="hidden" name="price" value="<?= $p['price'] ?>">
                <input type="hidden" name="image" value="<?= htmlspecialchars($p['image']) ?>">
                <button class="btn btn-dark btn-sm" name="add">
                  <i class="bi bi-cart-plus"></i> Add to Cart
                </button>
              </form>
            </div>
          </div>
        </div>
    <?php endwhile; 
    else:
      echo "<p class='text-center'>No products available</p>";
    endif;
    ?>
  </div>
</div>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
