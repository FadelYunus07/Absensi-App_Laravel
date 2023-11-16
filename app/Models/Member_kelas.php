<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Master_kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member_kelas extends Model
{

    protected $table = 'member_kelas';
    protected $fillable = ['master_id', 'siswa_id'];

    public function master()
    {
        return $this->belongsTo(Master_kelas::class,'master_id');
    }
    
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
    
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
    
    public function presensi()
    {
        return $this->belongsTo(Presensi::class, 'presensi_id');
    }
}
