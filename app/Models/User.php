<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $guarded = [];
    protected $hidden = ['password'];

    public static function getStats()
    {
        return [
            'total' => self::where('role', 'siswa')->count(),
            'pending' => self::where('role', 'siswa')->where('status', 'pending')->count(),
            'approved' => self::where('role', 'siswa')->where('status', 'approved')->count(),
            'blocked' => 0,
        ];
    }
}
