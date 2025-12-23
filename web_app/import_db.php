<?php
// Import schema and data into edutrack3 database
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=edutrack3', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Importing schema.sql...\n";
    $schema = file_get_contents(__DIR__ . '/../server/schema.sql');
    $pdo->exec($schema);
    echo "✓ Schema imported\n\n";
    
    echo "Importing data_login.sql...\n";
    $data = file_get_contents(__DIR__ . '/../server/data_login.sql');
    $pdo->exec($data);
    echo "✓ Data imported\n\n";
    
    // Verify
    $stmt = $pdo->query("SELECT * FROM users WHERE nrp='2472021' AND role='mahasiswa'");
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        echo "✓ Verification successful\n";
        echo "  User: {$user['nrp']}\n";
        echo "  Role: {$user['role']}\n";
        echo "  Password: {$user['password']}\n";
    } else {
        echo "✗ Verification failed - user not found\n";
    }
    
} catch (PDOException $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}
