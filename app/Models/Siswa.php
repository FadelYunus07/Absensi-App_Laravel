<?php

namespace App\Models;

use App\Models\User;
use App\Models\Presensi;
use App\Models\Member_kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongTo(User::class);
    }
    
    public function presensis()
    {
        return $this->hasMany(Presensi::class, 'nim_murid', 'id');
    }
    
    public function member_kelas()
    {
        return $this->belongTo(Member_kelas::class);
    }
}
