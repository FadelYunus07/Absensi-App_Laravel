<?php

namespace App\Models;

use App\Models\Guru;

use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Master_kelas;
use App\Models\Member_kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presensi extends Model
{
    use HasFactory;
    
    protected $fillable = ['siswa_id','master_id','mapel_id', 'status','point'];
    protected $guard = ['updated_at'];

    public function master()
    {
        return $this->belongsTo(Master_kelas::class, 'master_id', 'id');
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }
    public function member_kelas()
    {
        return $this->belongsTo(Member_kelas::class, 'member_kelas_id');
    }
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
}
