<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\Jadwal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mapel extends Model
{
    use HasFactory;
    protected $table = 'mapels';
    protected $fillable = ['kd_mapel', 'nm_mapel'];

    public function jadwal()
    {
        return $this->hasOne(Jadwal::class);
    }
    
    public function guru()
    {
        return $this->hasOne(Guru::class);
    }
}
