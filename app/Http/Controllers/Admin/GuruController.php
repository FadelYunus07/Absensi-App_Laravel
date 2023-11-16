<?php

namespace App\Http\Controllers\Admin;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gurus = Guru::with('mapel')->paginate(7);
        // foreach ($gurus as $guru) {
        //     $nm_mapel = optional($guru->mapel)->nm_mapel;
        //     dd($nm_mapel);
        // }
        return view('admin.guru', compact('gurus'));
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


    public function store(Request $request)
    {
        $last_id = User::orderBy('id', 'desc')->first()->id;
        $new_id = $last_id + 1;
        
        $user = new User;
        $user->id = $new_id;
        $user->password = Hash::make('password');
        $user->role = 'guru';
        $user->save();
        
        $guru = new Guru;
        $guru->id = $new_id;
        $guru->name = $request->name;
        // $guru->password = $request->password;
        $guru->kd_guru = $request->kd_guru;
        $guru->gender = $request->gender;
        $user->guru()->save($guru);

        return redirect()->route('guru')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show(Guru $guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit(Guru $guru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGuruRequest  $request
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGuruRequest $request, Guru $guru)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::with('guru')->find($id);

        if ($user) {
            if ($user->guru) {
                $user->guru->delete();
            }
            $user->delete();
            return redirect()->back()->with('success', 'Data guru berhasil dihapus.');
        }
    }
}
