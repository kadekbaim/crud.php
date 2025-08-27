<?php
// db.php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "chic_boutique"; // gunakan database "ecommerce" sesuai db.php kedua

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Start session jika belum jalan
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// helper: total qty di cart
function cart_count() {
    if (empty($_SESSION['cart'])) return 0;
    return array_sum(array_column($_SESSION['cart'], 'qty'));
}

// helper: rupiah
if (!function_exists('rupiah')) {
    function rupiah($angka) {
        return "Rp " . number_format($angka, 0, ',', '.');
    }
}
?>
