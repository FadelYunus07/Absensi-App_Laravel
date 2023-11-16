<?php

namespace App\Http\Controllers\Admin;

use App\Models\Master_kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaster_kelasRequest;
use App\Http\Requests\UpdateMaster_kelasRequest;

class MasterKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masteres = Master_kelas::paginate(6);
        return view('admin.masterkls', compact('masteres'));

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
        $request->validate([
            'kd_kelas' => 'required',
            'nm_kelas' => 'required',
        ]);
        // dd($request);
        Master_kelas::create([
            // 'id' => $request->id,
            'kd_kelas' => $request->kd_kelas,
            'nm_kelas' => $request->nm_kelas,
        ]);

        return redirect()->route('masters')->with('success', 'Data member_kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master_kelas  $master_kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Master_kelas $master_kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master_kelas  $master_kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Master_kelas $master_kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMaster_kelasRequest  $request
     * @param  \App\Models\Master_kelas  $master_kelas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMaster_kelasRequest $request, Master_kelas $master_kelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master_kelas  $master_kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $master = Master_kelas::all()->find($id);
        $master->delete();
        return redirect()->route('masters')->with('success', 'Data master_kelas berhasil dihapus.');
    }
}
