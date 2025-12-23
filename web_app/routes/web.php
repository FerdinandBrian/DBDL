<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// API Routes
Route::post('/api/login', [LoginController::class, 'login']);
Route::options('/api/login', function () {
    return response('', 200)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type');
});

// User Profile Routes
Route::get('/server/mhs.php', [UserController::class, 'getMahasiswa']);
Route::get('/server/dosen.php', [UserController::class, 'getDosen']);
Route::get('/server/admin.php', [UserController::class, 'getAdmin']);
