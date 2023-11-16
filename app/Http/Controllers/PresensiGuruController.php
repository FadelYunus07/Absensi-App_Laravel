<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Presensi;
use App\Models\Master_qr;
use App\Models\Master_kelas;
use App\Models\Member_kelas;
use App\Models\PresensiGuru;
use BaconQrCode\Encoder\QrCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePresensiGuruRequest;
use App\Http\Requests\UpdatePresensiGuruRequest;

class PresensiGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presensis = PresensiGuru::with('guru','mapel')->get();
        $gurus = Guru::all();
        $masters = Master_kelas::all();
        // $mstr = Master_kelas::find($id);

        // $master = Master_kelas::where('id', $id)->first();
        // $kd_kelas = $master->kd_kelas;
        $jam_msk = intval(str_replace(['.', '-'], '', date('Hi', time())));
        $hariqr = date('N', time());
        $hari = date('l', time());
        $tgl = str_replace(['.', '-'], '', date('Y-m-d'));
        // $members = Member_kelas::where('master_id', $id)->with('siswa')->get();
        
        if ($jam_msk < 700) {
            $jam_masuk = '07.00';
            $jam_msk = '0700';
        } elseif ($jam_msk >= 700 && $jam_msk < 830) {
            $jam_masuk = '08.30';
            $jam_msk = '0830';
        } elseif ($jam_msk >= 830 && $jam_msk < 1100) {
            $jam_masuk = '10.30';
            $jam_msk = '1030';
        }else {
            $jam_masuk = '08.30';
            $jam_msk = '0830';
        }
        

        $data = Master_qr::where('qr', 'like', '%'.$jam_msk.'%')
            ->where('qr', 'like', '%'.$tgl.'%')
            ->where('qr', 'like', '%'.$hariqr.'%')
            ->get();


        $mapel = '';
        foreach ($data as $item) {
            $kd_mapel = substr($item->qr, 3, 3);
        }

        $mapel = Mapel::where("kd_mapel",$kd_mapel)->first();       

        $tanggal = date('Y-m-d');
        // Buat QR code dari string yang telah digabungkan
        return view('admin.presensiGuru', compact('hari','jam_masuk','tanggal','mapel','presensis','gurus'));

    }

    public function downloadKelasGuruPDF()
    {
        // Ambil semua presensi guru dan presensi
        $presensis = PresensiGuru::with('guru','mapel')->get();
        $gurus = Guru::all();
        return view('admin.printGuru', compact('presensis','gurus'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePresensiGuruRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePresensiGuruRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PresensiGuru  $presensiGuru
     * @return \Illuminate\Http\Response
     */
    public function show(PresensiGuru $presensiGuru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PresensiGuru  $presensiGuru
     * @return \Illuminate\Http\Response
     */
    public function edit(PresensiGuru $presensiGuru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePresensiGuruRequest  $request
     * @param  \App\Models\PresensiGuru  $presensiGuru
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePresensiGuruRequest $request, PresensiGuru $presensiGuru)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PresensiGuru  $presensiGuru
     * @return \Illuminate\Http\Response
     */
    public function destroy(PresensiGuru $presensiGuru)
    {
        //
    }
}
