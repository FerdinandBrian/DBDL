<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getMahasiswa(Request $request)
    {
        $nrp = $request->query('nrp');
        
        if (!$nrp) {
            return response()->json([
                'success' => false,
                'message' => 'NRP required'
            ], 400)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type');
        }
        
        $mahasiswa = DB::table('mahasiswa')
            ->where('nrp', $nrp)
            ->first();
        
        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa not found'
            ], 404)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type');
        }
        
        return response()->json([
            'success' => true,
            'data' => $mahasiswa
        ])
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type');
    }
    
    public function getDosen(Request $request)
    {
        $nrp = $request->query('nrp');
        
        if (!$nrp) {
            return response()->json([
                'success' => false,
                'message' => 'NRP required'
            ], 400)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type');
        }
        
        $dosen = DB::table('dosen')
            ->where('nrp', $nrp)
            ->first();
        
        if (!$dosen) {
            return response()->json([
                'success' => false,
                'message' => 'Dosen not found'
            ], 404)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type');
        }
        
        return response()->json([
            'success' => true,
            'data' => $dosen
        ])
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type');
    }
    
    public function getAdmin(Request $request)
    {
        $nrp = $request->query('nrp');
        
        if (!$nrp) {
            return response()->json([
                'success' => false,
                'message' => 'NRP required'
            ], 400)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type');
        }
        
        $admin = DB::table('admin')
            ->where('nrp', $nrp)
            ->first();
        
        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Admin not found'
            ], 404)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type');
        }
        
        return response()->json([
            'success' => true,
            'data' => $admin
        ])
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type');
    }
}
