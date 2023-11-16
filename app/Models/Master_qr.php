<?php

namespace App\Models;

use App\Models\Jadwal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Master_qr extends Model
{
    use HasFactory;

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
}
