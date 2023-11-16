<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMapelRequest;
use App\Http\Requests\UpdateMapelRequest;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapels = Mapel::paginate(5);
        return view('admin.mapel', compact('mapels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMapelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kd_mapel' => 'required',
            'nm_mapel' => 'required',
            // 'thn_ajaran' => 'required',
        ]);

        Mapel::create([
            'kd_mapel' => $request->kd_mapel,
            'nm_mapel' => $request->nm_mapel,
            // 'thn_ajaran' => $request->thn_ajaran,
        ]);

        return redirect()->back()->with('success', 'Data member_kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapel $mapel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMapelRequest  $request
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMapelRequest $request, Mapel $mapel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mapel = Mapel::all()->find($id);
        $mapel->delete();
        return redirect()->back()->with('success', 'Data Mapel berhasil dihapus.');
    }
}
