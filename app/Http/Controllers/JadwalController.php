<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Jadwal;
use App\Models\Master_kelas;
use App\Models\Member_kelas;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreJadwalRequest;
use App\Http\Requests\UpdateJadwalRequest;

class JadwalController extends Controller
{
    public function index($id)
    {
        $jadwals = Jadwal::where('kelas_id', $id)->with('master', 'mapel')->paginate(5);
        $mapels = Mapel::all();
        $masters = Master_kelas::all();
        $master = Master_kelas::find($id);
        return view('admin.jadwal', compact('jadwals','mapels','masters','master'));
    }

    public function jadwalKelas()
    {
        $user = Auth::user()->id;
        $id = Member_kelas::where('siswa_id',$user)->pluck('master_id');
        $jadwalkls = Jadwal::where('kelas_id', $id)->with('master', 'mapel')->paginate(5);
        $mapels = Mapel::all();
        // $masters = Master_kelas::all();
        $mstr = Master_kelas::find($id);
        
        // dd($jadwalkls);

        return view('admin.jadwalkls', compact('jadwalkls','mapels','mstr'));
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
     * @param  \App\Http\Requests\StoreJadwalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJadwalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJadwalRequest  $request
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJadwalRequest $request, Jadwal $jadwal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        //
    }
}
