<?php

namespace App\Models;

use App\Models\Jadwal;
use App\Models\Member_kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Master_kelas extends Model
{
    use HasFactory;
    protected $table = 'master_kelas';
    protected $fillable = ['kd_kelas', 'nm_kelas'];

    public function member_kelas()
    {
        return $this->hasMany(Member_kelas::class, 'master_id', 'id');
    }
    
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'kelas_id', 'id');
    }
}
