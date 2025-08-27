<?php
include 'db.php';
$msg = "";
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $username = $conn->real_escape_string($_POST['username']);
  $email    = $conn->real_escape_string($_POST['email']);
  $passHash = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $cek = $conn->query("SELECT id FROM users WHERE email='$email' LIMIT 1");
  if ($cek->num_rows>0) { $msg="Email sudah terdaftar."; }
  else {
    $conn->query("INSERT INTO users (username,email,password,role) VALUES ('$username','$email','$passHash','user')");
    $_SESSION['flash']="Registrasi berhasil, silakan login.";
    header("Location: login.php"); exit;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register - Chic Boutique</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container mt-5" style="max-width:520px;">
  <h2 class="mb-4 text-center">Register</h2>
  <?php if($msg): ?><div class="alert alert-danger"><?= htmlspecialchars($msg) ?></div><?php endif; ?>
  <form method="post">
    <div class="mb-3"><label class="form-label">Username</label><input class="form-control" name="username" required></div>
    <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" name="email" required></div>
    <div class="mb-3"><label class="form-label">Password</label><input type="password" class="form-control" name="password" required></div>
    <button class="btn btn-dark w-100">Register</button>
  </form>
</div>
<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body></html>
