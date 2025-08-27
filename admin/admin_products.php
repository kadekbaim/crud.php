<?php
include '../project/db.php';

// Fungsi format harga
function rupiah($angka){
    return "Rp " . number_format($angka,0,',','.');
}

// Tambah produk baru
if(isset($_POST['add_product'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];

    // Pastikan folder img ada
    $img_folder = '../project/img/';
    if(!is_dir($img_folder)){
        mkdir($img_folder, 0755, true);
    }

    move_uploaded_file($tmp_name, $img_folder.$image);
    $conn->query("INSERT INTO products (name, price, image) VALUES ('$name', '$price', '$image')");
    header('Location: admin_products.php');
    exit;
}

// Hapus produk
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM products WHERE id='$id'");
    header('Location: admin_products.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin - Products</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <h2 class="mb-4">Manage Products</h2>

    <!-- Form tambah produk -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="name" class="form-control" placeholder="Product Name" required>
                </div>
                <div class="col-md-3">
                    <input type="number" name="price" class="form-control" placeholder="Price" required>
                </div>
                <div class="col-md-3">
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" name="add_product" class="btn btn-primary w-100">Add Product</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Produk -->
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = $conn->query("SELECT * FROM products");
                    while($p = $res->fetch_assoc()):
                        $img_path = '../project/img/'.$p['image'];
                    ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td>
                            <?php if(file_exists($img_path)): ?>
                                <img src="<?= $img_path ?>" style="height:60px;object-fit:cover;">
                            <?php else: ?>
                                <span class="text-danger">No Image</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($p['name']) ?></td>
                        <td><?= rupiah($p['price']) ?></td>
                        <td>
                            <a href="admin_products.php?delete=<?= $p['id'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
