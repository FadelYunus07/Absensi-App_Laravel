<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiGuru extends Model
{
    use HasFactory;
    protected $fillable = ['guru_id','status','point','waktu_absen'];


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
