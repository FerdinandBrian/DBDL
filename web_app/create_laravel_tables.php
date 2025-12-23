<?php
// Create sessions table manually
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=edutrack3', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Creating sessions table...\n";
    $sql = "CREATE TABLE IF NOT EXISTS sessions (
        id varchar(255) NOT NULL PRIMARY KEY,
        user_id bigint unsigned DEFAULT NULL,
        ip_address varchar(45) DEFAULT NULL,
        user_agent text,
        payload longtext NOT NULL,
        last_activity int NOT NULL,
        KEY sessions_user_id_index (user_id),
        KEY sessions_last_activity_index (last_activity)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $pdo->exec($sql);
    echo "✓ Sessions table created\n";
    
    // Also create cache table
    echo "Creating cache table...\n";
    $sql = "CREATE TABLE IF NOT EXISTS cache (
        `key` varchar(255) NOT NULL PRIMARY KEY,
        value mediumtext NOT NULL,
        expiration int NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $pdo->exec($sql);
    echo "✓ Cache table created\n";
    
    // Create cache_locks table
    echo "Creating cache_locks table...\n";
    $sql = "CREATE TABLE IF NOT EXISTS cache_locks (
        `key` varchar(255) NOT NULL PRIMARY KEY,
        owner varchar(255) NOT NULL,
        expiration int NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $pdo->exec($sql);
    echo "✓ Cache_locks table created\n";
    
    // Create jobs table
    echo "Creating jobs table...\n";
    $sql = "CREATE TABLE IF NOT EXISTS jobs (
        id bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
        queue varchar(255) NOT NULL,
        payload longtext NOT NULL,
        attempts tinyint unsigned NOT NULL,
        reserved_at int unsigned DEFAULT NULL,
        available_at int unsigned NOT NULL,
        created_at int unsigned NOT NULL,
        KEY jobs_queue_index (queue)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $pdo->exec($sql);
    echo "✓ Jobs table created\n";
    
} catch (PDOException $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}
