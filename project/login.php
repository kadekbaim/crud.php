<?php
include 'db.php';
$msg = "";
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $email = $conn->real_escape_string($_POST['email']);
  $pass  = $_POST['password'];
  $q = $conn->query("SELECT * FROM users WHERE email='$email' LIMIT 1");
  if ($u = $q->fetch_assoc()) {
    if (password_verify($pass, $u['password'])) {
      $_SESSION['user'] = ['id'=>$u['id'], 'username'=>$u['username'], 'email'=>$u['email']];
      header("Location: index.php"); exit;
    }
  }
  $msg = "Email atau password salah.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Chic Boutique</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container mt-5" style="max-width:480px;">
  <h2 class="mb-4 text-center">Login</h2>
  <?php if($msg): ?><div class="alert alert-danger"><?= htmlspecialchars($msg) ?></div><?php endif; ?>
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" class="form-control" name="email" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" class="form-control" name="password" required>
    </div>
    <button class="btn btn-dark w-100">Login</button>
    <div class="text-center mt-3">
      Belum punya akun? <a href="register.php">Register</a>
    </div>
  </form>
</div>
<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body></html>
