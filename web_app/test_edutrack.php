<?php
// Test connection to edutrack database
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=edutrack', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✓ Connected to 'edutrack' database\n\n";
    
    // Check if required tables exist
    $tables = ['userlogin', 'mahasiswa', 'dosen', 'admin'];
    echo "Checking tables:\n";
    
    foreach ($tables as $table) {
        $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
        if ($stmt->rowCount() > 0) {
            echo "  ✓ Table '$table' exists\n";
            
            // Count records
            $count = $pdo->query("SELECT COUNT(*) FROM $table")->fetchColumn();
            echo "    → $count records\n";
        } else {
            echo "  ✗ Table '$table' NOT found\n";
        }
    }
    
    // Test user data
    echo "\nTesting user login data:\n";
    $stmt = $pdo->query("SELECT nrp, role FROM users LIMIT 5");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "  - {$row['role']}: {$row['nrp']}\n";
    }
    
} catch (PDOException $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}
