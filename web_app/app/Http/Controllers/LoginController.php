<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'nrp' => 'required|string',
            'password' => 'required|string',
            'role' => 'required|in:mahasiswa,dosen,admin'
        ]);

        $user = User::where('nrp', $request->nrp)
                    ->where('role', $request->role)
                    ->first();

        if (!$user || $user->password !== $request->password) {
            return response()->json([
                'success' => false,
                'message' => 'NRP atau password salah'
            ], 401)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type');
        }

        // Determine redirect URL based on role
        $redirectMap = [
            'mahasiswa' => './dashboard-mhs.html',
            'dosen' => './dashboard-dosen.html',
            'admin' => './dashboard-admin.html'
        ];

        return response()->json([
            'success' => true,
            'role' => $user->role,
            'nrp' => $user->nrp,
            'redirect' => $user->redirect ?? $redirectMap[$user->role]
        ])
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type');
    }
}
