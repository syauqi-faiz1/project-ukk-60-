<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getStats($userId = null)
    {
        $q = self::query();
        if ($userId) $q->where('user_id', $userId);
        $total = $q->count();
        $base = $userId ? self::where('user_id', $userId) : self::query();
        return [
            'total' => $total,
            'pending' => (clone $base)->where('status', 'pending')->count(),
            'diproses' => (clone $base)->where('status', 'diproses')->count(),
            'selesai' => (clone $base)->where('status', 'selesai')->count(),
        ];
    }
}
