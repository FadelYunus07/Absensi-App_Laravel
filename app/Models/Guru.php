<?php

namespace App\Models;

use App\Models\User;
use App\Models\Mapel;
use App\Models\Presensi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends Model
{
    use HasFactory;
    protected $fillable = ['nama','mapel_id', 'gender', 'kd_guru'];

    public function user()
    {
        return $this->belongTo(User::class);
    }
    
    public function presensis()
    {
        return $this->hasMany(Presensi::class, 'id_guru', 'id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id', 'id');
    }
}
