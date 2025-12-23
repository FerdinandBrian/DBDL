<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    $user = \App\Models\User::where('nrp', '2472021')
                            ->where('role', 'mahasiswa')
                            ->first();
    
    if ($user) {
        echo "✓ Database connected\n";
        echo "✓ User found: {$user->nrp}\n";
        echo "✓ Role: {$user->role}\n";
        echo "✓ Password in DB: {$user->password}\n";
    } else {
        echo "✗ User NOT found in database\n";
    }
} catch (\Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}
