<?php
include_once __DIR__ . '/bin/config.php';

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);

    $pdo->exec("CREATE TABLE IF NOT EXISTS Users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(100) NOT NULL,
        last_name VARCHAR(100) NOT NULL,
        birthday DATE,
        email VARCHAR(150) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL,
        country VARCHAR(100),
        role ENUM('admin', 'user') DEFAULT 'user',
        reset_token VARCHAR(255) DEFAULT NULL,
        reset_tokenExpires_at DATETIME DEFAULT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        
    
    )");
    echo "Users table created successfully.<br>";

    $pdo->exec("CREATE TABLE IF NOT EXISTS Posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        author_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        category VARCHAR(100) NOT NULL,
        content TEXT NOT NULL,
        image_url VARCHAR(255),
        is_nsfw BOOLEAN DEFAULT FALSE,
        status ENUM('draft', 'published') DEFAULT 'published',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,        
        FOREIGN KEY (author_id) REFERENCES Users(id) ON DELETE CASCADE
    )");
    echo "Posts table created successfully.<br>";

    ensure_public_id_column($pdo, 'Users');
    ensure_public_id_column($pdo, 'Posts');
    echo "Public IDs ensured for all tables.<br>";

    echo "<br><b>Database setup is complete! Please delete this setup_db.php file for security purposes.</b>";

} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}
?>