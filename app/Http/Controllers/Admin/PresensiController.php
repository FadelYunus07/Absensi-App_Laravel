<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Jadwal;
use App\Models\Presensi;
use App\Models\Master_qr;
use App\Models\Master_kelas;
use App\Models\Member_kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class PresensiController extends Controller
{
    //QR Kelas
    public function index($id)
    {
        // date_default_timezone_set('Asia/Jakarta');
        $master = Master_kelas::where('id', $id)->first();
        $kd_kelas = $master->kd_kelas;
        $jam_msk = intval(str_replace(['.', '-'], '', date('Hi', time())));
        $hari = date('N', time());
        $tgl = str_replace(['.', '-'], '', date('Y-m-d'));
        // $mapel = Mapel::find('mapel_id')->first();
        
        // dd($jam_msk);
        if ($jam_msk < 700) {
            $jam_masuk = '07.00';
            $jam_msk = '0700';
        } elseif ($jam_msk >= 715 && $jam_msk <= 830) {
            $jam_masuk = '08.30';
            $jam_msk = '0830';
            
        } elseif ($jam_msk > 845 && $jam_msk < 1100) {
            $jam_masuk = '10.30';
            $jam_msk = '1030';
        } 
        else {
            $jam_masuk = '08.30';
            $jam_msk = '0830';
        }
        
        // dd($hari);
        
        $data = Master_qr::where('qr', 'like', $kd_kelas.'%')
            ->where('qr', 'like', '%'.$jam_msk.'%')
            ->where('qr', 'like', '%'.$tgl.'%')
            ->where('qr', 'like', '%'.$hari.'%')
            ->get('qr');

        // dd($data);
        $mapel = '';
        foreach ($data as $item) {
            $kd_mapel = substr($item->qr, 3, 3);
        }
        // dd($item);
       

        $mapel = Mapel::where("kd_mapel",$kd_mapel)->first();

        $tanggal = date('Y-m-d');
        // Buat QR code dari string yang telah digabungkan
        $qrCodes = QrCode::format('png')->size(300)->generate(json_encode($data));
        return view('admin.absen', compact('qrCodes','master','jam_masuk','tanggal','mapel'));
    }

    public function presensiKelas($id)
    {
        // // Ambil semua presensi guru dan presensi
        $presensis = Presensi::where('master_id', $id)->with('siswa','mapel')->get();
        $siswas = Siswa::all();
        $masters = Master_kelas::all();
        $mstr = Master_kelas::find($id);

        $master = Master_kelas::where('id', $id)->first();
        $kd_kelas = $master->kd_kelas;
        $jam_msk = intval(str_replace(['.', '-'], '', date('Hi', time())));
        $hariqr = date('N', time());
        $hari = date('l', time());
        $tgl = str_replace(['.', '-'], '', date('Y-m-d'));
        $members = Member_kelas::where('master_id', $id)->with('siswa')->get();
        
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
        

        $data = Master_qr::where('qr', 'like', $kd_kelas.'%')
            ->where('qr', 'like', '%'.$jam_msk.'%')
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
        return view('admin.presensi', compact('members','hari','master','jam_masuk','tanggal','mapel','masters','mstr','presensis','siswas'));

    }

    public function downloadPresensiPDF($id)
    {
        // Ambil semua presensi guru dan presensi
        $members = Member_kelas::where('master_id', $id)->with('master', 'siswa','presensi')->get();
        $masters = Master_kelas::find($id);
        $presensis = Presensi::all();
        return view('admin.print', compact('presensis','masters','members'));
    }
    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'master_id' => 'required',
            // 'mapel_id' => 'required',
        ]);

        
        Presensi::create([
            'master_id' => $request->master_id,
            'siswa_id' => $request->siswa_id,
            // 'mapel_id' => $request->mapel_id,
            'status' => 'tidak hadir',
            'point' => 0,
            'waktu_absen_masuk' => now(),
            'waktu_absen_pulang' => now()
        ]);

        return redirect()->back()->with('success', 'Data member_kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Presensi  $presensi
     * @return \Illuminate\Http\Response
     */
    public function show(Presensi $presensi)
    {
        //
    }

    public function edit(Presensi $presensi)
    {
        //
    }
    
    public function update($id)
    {
        $presensi = Presensi::where('id', $id)->first();

        // Periksa status saat ini
        if ($presensi->status == 'tidak hadir') {
            // Jika saat ini "tidak hadir", ubah menjadi "hadir"
            $presensi->status = 'hadir';
            $presensi->point += 1;

        } else {
            // Jika saat ini "hadir", ubah menjadi "tidak hadir"
            $presensi->status = 'tidak hadir';
            $presensi->point -= 1;
        }

        $presensi->updated_at = now()->toDateString();

        $presensi->save();

        return redirect()->back()->with('success', 'Status kehadiran berhasil diperbarui.');
    }


    public function destroy(Presensi $presensi)
    {
        //
    }
}
