<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact - Chic Boutique</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<section class="bg-dark text-white text-center p-5">
  <h1 class="fw-bold">Contact Us</h1>
  <p class="lead">We’d love to hear from you</p>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6">
        <h2 class="fw-bold mb-3">Get in Touch</h2>
        <p>Tim kami siap membantu pertanyaan dan kebutuhanmu.</p>
        <ul class="list-unstyled">
          <li><strong>Email:</strong> support@chicboutique.com</li>
          <li><strong>Phone:</strong> +62 812-3456-7890</li>
          <li><strong>Address:</strong> Jl. Buntu No. 21, Gianyar</li>
        </ul>
      </div>
      <div class="col-md-6">
        <form>
          <div class="mb-3"><label class="form-label">Full Name</label><input type="text" class="form-control" placeholder="Your Name"></div>
          <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" placeholder="you@example.com"></div>
          <div class="mb-3"><label class="form-label">Message</label><textarea class="form-control" rows="4" placeholder="Write your message here..."></textarea></div>
          <button class="btn btn-dark">Send Message</button>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body></html>
