<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Illuminate\Support\Facades\Hash;

use App\Models\Guru;
use App\Models\User;

use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with('admin','guru','siswa')->paginate(7);
        
        return view('admin.user.index',compact('users'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {   
        $last_id = User::orderBy('id', 'desc')->first()->id;
        $new_id = $last_id + 1;

        $user = new User;
        $user->id = $new_id;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        if ($request->input('no_karyawan')) {
            $admin = new Admin;
            $admin->name = $request->name;
            $admin->no_karyawan = $request->no_karyawan;
            $user->admin()->save($admin);
        } elseif ($request->input('kd_guru')) {
            $guru = new Guru;
            $guru->name = $request->name;
            $guru->kd_guru = $request->kd_guru;
            $user->guru()->save($guru);
        } elseif ($request->input('nim_murid')) {
            $siswa = new Siswa;
            $siswa->name = $request->name;
            $siswa->nim_murid = $request->nim_murid;
            $siswa->gender = $request->gender;
            $user->guru()->save($siswa);
        }

        return redirect()->route('kelolaUser')->with('success', 'Data berhasil ditambahkan');
    }

    public function show($id)
    {
        
    }

    public function edit(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
    }

    public function destroy($id)
    {
        $user = User::with('admin', 'guru')->find($id);

        if ($user) {
            if ($user->admin) {
                $user->admin->delete();
            }
            if ($user->guru) {
                $user->guru->delete();
            }
            if ($user->siswa) {
                $user->siswa->delete();
            }

            
            $user->delete();
            return redirect()->route('kelolaUser')->with('success', 'Data User berhasil dihapus');
        } else {
            return redirect()->route('kelolaUser')->with('error', 'Data User gagal dihapus');
        }

        
    }
}
