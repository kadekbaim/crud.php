<?php
// admin_orders.php
include '../project/db.php'; // sesuaikan path db.php

// Update status pesanan
if (isset($_POST['update_status'])) {
    $order_id = $_POST['id'];
    $status = $_POST['status'];
    $stmt = $conn->prepare("UPDATE orders SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $order_id);
    $stmt->execute();
    $stmt->close();
    header("Location: admin_orders.php");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Manage Orders</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $res = $conn->query("
            SELECT o.id AS order_id, o.total, o.status, o.created_at, u.username AS customer,
                   p.name AS product_name, oi.quantity, oi.price
            FROM orders o
            JOIN users u ON o.user_id = u.id
            JOIN order_items oi ON oi.order_id = o.id
            JOIN products p ON oi.product_id = p.id
            ORDER BY o.id DESC
        ");

        while($o = $res->fetch_assoc()):
        ?>
            <tr>
                <td><?= $o['order_id'] ?></td>
                <td><?= htmlspecialchars($o['customer']) ?></td>
                <td><?= htmlspecialchars($o['product_name']) ?></td>
                <td><?= $o['quantity'] ?></td>
                <td><?= rupiah($o['price'] * $o['quantity']) ?></td>
                <td><?= ucfirst($o['status']) ?></td>
                <td>
                    <form action="" method="post" class="d-flex gap-2 justify-content-center">
                        <input type="hidden" name="id" value="<?= $o['order_id'] ?>">
                        <select name="status" class="form-select form-select-sm">
                            <option value="pending" <?= $o['status']=='pending'?'selected':'' ?>>Pending</option>
                            <option value="paid" <?= $o['status']=='paid'?'selected':'' ?>>Paid</option>
                            <option value="shipped" <?= $o['status']=='shipped'?'selected':'' ?>>Shipped</option>
                            <option value="completed" <?= $o['status']=='completed'?'selected':'' ?>>Completed</option>
                            <option value="cancelled" <?= $o['status']=='cancelled'?'selected':'' ?>>Cancelled</option>
                        </select>
                        <button type="submit" name="update_status" class="btn btn-success btn-sm"><i class="bi bi-check2"></i></button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
