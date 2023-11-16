<?php

namespace App\Models;

use App\Models\Mapel;
use App\Models\Master_qr;
use App\Models\Master_kelas;
use App\Models\Member_kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwals';
    protected $fillable = ['kelas_id', 'mapel_id','jam_masuk','jam_pulang','hari'];

    public function master()
    {
        return $this->belongsTo(Master_kelas::class, 'kelas_id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
    
    public function member()
    {
        return $this->belongsTo(Member_kelas::class, 'mapel_id');
    }

    public function masterqr()
    {
        return $this->hasOne(Master_qr::class);
    }
}
