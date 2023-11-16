<?php

namespace App\Models;


use App\Models\Master_kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hadir_guru extends Model
{
    use HasFactory;
    protected $fillable = ['guru_id', 'jam_masuk', 'jam_pulang', 'koordinate_gps_masuk', 'koordinate_gps_pulang'];

    public function master()
    {
        return $this->belongsTo(Master_kelas::class, 'master_id', 'id');
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }
}
