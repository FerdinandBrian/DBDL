<?php
// Test login with edutrack database and userlogin table
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=edutrack', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✓ Connected to 'edutrack' database\n\n";
    
    // Check userlogin table
    echo "Checking userlogin table:\n";
    $stmt = $pdo->query("SELECT COUNT(*) FROM userlogin");
    $count = $stmt->fetchColumn();
    echo "  ✓ Table 'userlogin' has $count records\n\n";
    
    // Show all users
    echo "User data in userlogin:\n";
    $stmt = $pdo->query("SELECT nrp, role FROM userlogin");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "  - {$row['role']}: {$row['nrp']}\n";
    }
    
    echo "\n✓ Ready to use with Laravel!\n";
    
} catch (PDOException $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}
