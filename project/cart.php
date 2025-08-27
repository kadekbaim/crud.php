<?php
session_start();
include 'db.php'; // pastikan ada fungsi rupiah()

// Inisialisasi keranjang
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Tambah ke cart
if (isset($_POST['add'])) {
    $id    = (int)$_POST['id'];
    $name  = trim($_POST['name']);
    $price = (int)$_POST['price'];
    $image = trim($_POST['image']);

    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = [
            'id'    => $id,
            'name'  => $name,
            'price' => $price,
            'image' => $image,
            'qty'   => 1
        ];
    } else {
        $_SESSION['cart'][$id]['qty']++;
    }
    $_SESSION['flash'] = "Produk ditambahkan ke keranjang.";
    header("Location: cart.php"); exit;
}

// Update qty
if (isset($_POST['update_qty'])) {
    $id = (int)$_POST['id'];
    $dir = $_POST['dir']; // inc|dec
    if (isset($_SESSION['cart'][$id])) {
        if ($dir === 'inc') $_SESSION['cart'][$id]['qty']++;
        if ($dir === 'dec') $_SESSION['cart'][$id]['qty'] = max(1, $_SESSION['cart'][$id]['qty'] - 1);
    }
    header("Location: cart.php"); exit;
}

// Hapus item
if (isset($_GET['remove'])) {
    $rid = (int)$_GET['remove'];
    unset($_SESSION['cart'][$rid]);
    $_SESSION['flash'] = "Item dihapus dari keranjang.";
    header("Location: cart.php"); exit;
}

// Kosongkan cart
if (isset($_GET['clear'])) {
    $_SESSION['cart'] = [];
    $_SESSION['flash'] = "Keranjang dikosongkan.";
    header("Location: cart.php"); exit;
}

// Ambil item cart
$items = $_SESSION['cart'] ?? [];
$grand = 0;
foreach ($items as $it) {
    $grand += $it['price'] * $it['qty'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cart - Chic Boutique</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <style>
    .cart-img {
        width: 80px;
        height: 80px;
        object-fit: contain;
    }
    .qty-btn { width: 30px; }
  </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container mt-5">
  <h2 class="mb-3">Keranjang Belanja</h2>

  <?php if (!empty($_SESSION['flash'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= htmlspecialchars($_SESSION['flash']); unset($_SESSION['flash']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <?php if ($items): ?>
    <div class="table-responsive">
      <table class="table align-middle table-hover">
        <thead class="table-dark">
          <tr>
            <th>Image</th>
            <th>Produk</th>
            <th>Harga</th>
            <th class="text-center">Qty</th>
            <th>Subtotal</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($items as $id=>$it): $sub=$it['price']*$it['qty']; ?>
          <tr>
            <td>
              <?php if (!empty($it['image'])): ?>
                <img src="<?= htmlspecialchars($it['image']) ?>" class="img-thumbnail cart-img" alt="<?= htmlspecialchars($it['name']) ?>">
              <?php else: ?>
                <span class="text-muted">No image</span>
              <?php endif; ?>
            </td>
            <td class="fw-semibold"><?= htmlspecialchars($it['name']) ?></td>
            <td><?= rupiah($it['price']) ?></td>
            <td class="text-center">
              <form method="post" class="d-inline">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="hidden" name="dir" value="dec">
                <button class="btn btn-sm btn-outline-secondary qty-btn" name="update_qty">-</button>
              </form>
              <span class="mx-2"><?= $it['qty'] ?></span>
              <form method="post" class="d-inline">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="hidden" name="dir" value="inc">
                <button class="btn btn-sm btn-outline-secondary qty-btn" name="update_qty">+</button>
              </form>
            </td>
            <td><?= rupiah($sub) ?></td>
            <td>
              <a class="btn btn-sm btn-outline-danger" href="cart.php?remove=<?= $id ?>">
                <i class="bi bi-trash"></i> Hapus
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr class="table-light">
            <th colspan="4" class="text-end">Grand Total</th>
            <th><?= rupiah($grand) ?></th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="d-flex justify-content-between mt-3">
      <a href="shop.php" class="btn btn-outline-secondary">← Lanjut Belanja</a>
      <div>
        <a href="cart.php?clear=1" class="btn btn-outline-danger me-2">Kosongkan</a>
        <a href="checkout.php" class="btn btn-success">Checkout</a>
      </div>
    </div>
  <?php else: ?>
    <div class="alert alert-warning">Keranjang masih kosong. <a href="shop.php" class="alert-link">Belanja sekarang</a>.</div>
  <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
