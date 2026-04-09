<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplaintCategory extends Model
{
    protected $guarded = [];

    public function isInUse()
    {
        return Complaint::where('kategori', $this->nama)->exists();
    }
}
