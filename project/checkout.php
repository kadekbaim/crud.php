<?php
include 'db.php';
if (empty($_SESSION['user'])) {
  $_SESSION['flash'] = "Silakan login dulu untuk checkout.";
  header("Location: login.php"); exit;
}

$items = $_SESSION['cart'] ?? [];
if (!$items) { header("Location: cart.php"); exit; }

$grand = 0; foreach($items as $it){ $grand += $it['price']*$it['qty']; }

if ($_SERVER['REQUEST_METHOD']==='POST') {
  // Simpan order
  $uid = $_SESSION['user']['id'];
  $conn->query("INSERT INTO orders (user_id,total,status) VALUES ($uid,$grand,'pending')");
  $order_id = $conn->insert_id;

  // Simpan items
  $stmt = $conn->prepare("INSERT INTO order_items (order_id,product_id,quantity,price) VALUES (?,?,?,?)");
  foreach($_SESSION['cart'] as $pid=>$it){
    $q = $it['qty']; $pr = $it['price'];
    $stmt->bind_param("iiii",$order_id,$pid,$q,$pr);
    $stmt->execute();
  }
  $stmt->close();

  // Kosongkan cart
  $_SESSION['cart'] = [];
  $_SESSION['flash'] = "Checkout berhasil! Order #$order_id dibuat.";
  header("Location: orders.php"); exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Checkout - Chic Boutique</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container mt-5">
  <h2 class="mb-3">Checkout</h2>
  <div class="row g-4">
    <div class="col-lg-7">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Rincian Pesanan</h5>
          <ul class="list-group">
            <?php foreach($items as $id=>$it): ?>
              <li class="list-group-item d-flex justify-content-between">
                <span><?= htmlspecialchars($it['name']) ?> × <?= $it['qty'] ?></span>
                <span><?= rupiah($it['price']*$it['qty']) ?></span>
              </li>
            <?php endforeach; ?>
            <li class="list-group-item d-flex justify-content-between">
              <strong>Total</strong><strong><?= rupiah($grand) ?></strong>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Data Penerima</h5>
          <!-- Form dummy (bisa dikembangkan) -->
          <form method="post">
            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Alamat</label>
              <textarea class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">No. HP</label>
              <input class="form-control" required>
            </div>
            <button class="btn btn-success w-100">Buat Pesanan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body></html>
