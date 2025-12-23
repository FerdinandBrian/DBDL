<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    
    protected $table = 'userlogin';
    
    public $timestamps = false;
    
    protected $fillable = [
        'nrp',
        'password',
        'role',
        'redirect'
    ];
    
    protected $hidden = [
        'password',
    ];
}
