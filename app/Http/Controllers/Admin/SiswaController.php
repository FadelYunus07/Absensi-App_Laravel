<?php

namespace App\Http\Controllers\Admin;

use App\Models\Guru;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswas = Siswa::paginate(7);
        return view('admin.siswa', compact('siswas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSiswaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $last_id = User::orderBy('id', 'desc')->first()->id;
        $new_id = $last_id + 1;
        
        $user = new User;
        $user->id = $new_id;
        $user->password = Hash::make('password');
        $user->role = 'siswa';
        $user->save();
        
        $siswa = new Siswa;
        $siswa->id = $new_id;
        $siswa->name = $request->name;
        // $siswa->password = $request->password;
        $siswa->nim_murid = $request->nim_murid;
        $siswa->gender = $request->gender;
        $user->siswa()->save($siswa);


        return redirect()->route('siswa')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSIswaRequest  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::with('siswa')->find($id);

        if ($user) {
            if ($user->siswa) {
                $user->siswa->delete();
            }
            $user->delete();
            return redirect()->route('siswa')->with('success', 'Data User berhasil dihapus');
        }
    }
}
