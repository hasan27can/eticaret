<?php
// Veritabanı bağlantınızı buraya dahil edin veya PDO örneğini başlatın
$host = getenv('DB_HOST') ?: 'localhost';
$dbname = getenv('DB_NAME') ?: 'eticaret';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}

// 1. Ürünleri Çekmeyi Dene
try {
    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    $products = [];
}

// 2. OTOMATİK KURULUM: Ürün sayısı 0 ise kurulum dosyasını çalıştır
if (empty($products)) {
    if (file_exists(__DIR__ . '/setup-db.php')) {
        require_once __DIR__ . '/setup-db.php';
        
        // Kurulum bittikten sonra ürünleri tekrar çek
        $stmt = $pdo->query("SELECT * FROM products");
        $products = $stmt->fetchAll();
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Kataloğu - TeknoMağaza</title>
    <style>
        body { font-family: sans-serif; background-color: #0d1117; color: #fff; padding: 20px; }
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; margin-top: 20px; }
        .card { background: #161b22; border: 1px solid #30363d; border-radius: 8px; padding: 15px; }
        .price { color: #58a6ff; font-weight: bold; }
    </style>
</head>
<body>

    <h1>TeknoMağaza</h1>
    <p>Toplam <strong><?php echo count($products); ?></strong> ürün listeleniyor</p>

    <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <div class="card">
                <h3><?php echo htmlspecialchars($product['title']); ?></h3>
                <p class="price"><?php echo number_format($product['price'], 2, ',', '.'); ?> TL</p>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>