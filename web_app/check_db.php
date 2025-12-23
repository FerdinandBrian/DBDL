<?php
// Test MySQL connection and list databases
try {
    $pdo = new PDO('mysql:host=127.0.0.1', 'root', '');
    echo "✓ MySQL connection successful\n\n";
    
    echo "Available databases:\n";
    $stmt = $pdo->query('SHOW DATABASES');
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        echo "  - {$row[0]}\n";
    }
    
    // Check if edutrack3 exists
    $stmt = $pdo->query("SHOW DATABASES LIKE 'edutrack3'");
    if ($stmt->rowCount() > 0) {
        echo "\n✓ Database 'edutrack3' exists\n";
    } else {
        echo "\n✗ Database 'edutrack3' does NOT exist\n";
        echo "\nCreating database 'edutrack3'...\n";
        $pdo->exec('CREATE DATABASE edutrack3');
        echo "✓ Database created\n";
    }
    
} catch (PDOException $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}
