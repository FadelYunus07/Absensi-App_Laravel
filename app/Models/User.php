<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\Admin;
use App\Models\Siswa;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $fillable = [
        'username', 'password', 'role'
    ];

    protected $hidden = [
        'password',
    ];

    public function isAdmin()
    {
        return $this->admin()->exists();
    }

    public function isGuru()
    {
        return $this->guru()->exists();
    }
    public function isSiswa()
    {
        return $this->siswa()->exists();
    }
    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function guru()
    {
        return $this->hasOne(Guru::class);
    }
    
    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }
    
}
