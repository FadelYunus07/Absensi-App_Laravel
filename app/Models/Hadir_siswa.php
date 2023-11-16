<?php

namespace App\Models;

use App\Models\Siswa;
use App\Models\Master_kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hadir_siswa extends Model
{
    use HasFactory;
    protected $fillable = ['member_id','siswa_id', 'jam_masuk', 'jam_pulang', 'koordinate_masuk', 'koordinate_pulang'];

    public function master()
    {
        return $this->belongsTo(Master_kelas::class, 'master_id', 'id');
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
}
