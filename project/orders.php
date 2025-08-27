<?php
include 'db.php';
if (empty($_SESSION['user'])) { header("Location: login.php"); exit; }
$uid = $_SESSION['user']['id'];
$orders = $conn->query("SELECT * FROM orders WHERE user_id=$uid ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Orders - Chic Boutique</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container mt-5">
  <h2 class="mb-3">Order History</h2>

  <?php if (!empty($_SESSION['flash'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
      <?= htmlspecialchars($_SESSION['flash']); unset($_SESSION['flash']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <div class="table-responsive">
    <table class="table align-middle">
      <thead class="table-dark"><tr><th>#Order</th><th>Date</th><th>Status</th><th>Total</th></tr></thead>
      <tbody>
        <?php while($o = $orders->fetch_assoc()): ?>
          <tr>
            <td>#<?= $o['id'] ?></td>
            <td><?= $o['created_at'] ?></td>
            <td><span class="badge bg-secondary"><?= $o['status'] ?></span></td>
            <td><?= rupiah($o['total']) ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body></html>
