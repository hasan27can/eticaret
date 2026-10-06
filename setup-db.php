<?php
// Veritabanı Bağlantı Ayarları
$host = getenv('DB_HOST') ?: 'localhost';
$dbname = getenv('DB_NAME') ?: 'eticaret';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // 1. Yabancı anahtar kısıtlamalarını devre dışı bırak (Hatanın kesin çözümü)
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0;");

    // 2. Tabloları sil
    $pdo->exec("DROP TABLE IF EXISTS reviews;");
    $pdo->exec("DROP TABLE IF EXISTS products;");
    $pdo->exec("DROP TABLE IF EXISTS categories;");

    // 3. Tabloları yeniden oluştur
    $pdo->exec("
        CREATE TABLE categories (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        CREATE TABLE products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            category_id INT,
            title VARCHAR(255) NOT NULL,
            price DECIMAL(10, 2) NOT NULL,
            image VARCHAR(255) DEFAULT 'placeholder.png',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        CREATE TABLE reviews (
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_id INT NOT NULL,
            rating INT DEFAULT 5,
            comment TEXT,
            FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    // 4. Örnek Verileri Ekle
    $pdo->exec("
        INSERT INTO categories (id, name) VALUES (1, 'Teknoloji');

        INSERT INTO products (title, price, category_id) VALUES 
        ('Kablosuz Kulaklık', 1299.99, 1),
        ('Akıllı Saat', 2499.50, 1),
        ('Mekanik Klavye', 899.00, 1),
        ('Oyuncu Faresi', 450.00, 1),
        ('Laptop Standı', 299.90, 1);
    ");

    // 5. Yabancı anahtar kısıtlamalarını tekrar aktif et
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1;");

} catch (PDOException $e) {
    die("Hata: " . $e->getMessage());
}
?>