<?php

namespace App\Http\Controllers\User;

use App\Models\Guru;
use App\Models\Absen;
use App\Models\Mapel;

use App\Models\Presensi;
use App\Models\Master_kelas;
use App\Models\Member_kelas;
use App\Models\PresensiGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAbsenRequest;
use App\Http\Requests\UpdateAbsenRequest;

class AbsenController extends Controller
{
    public function index()
    {
        return view('admin.scanner');
    }

    public function scan(Request $request)
    {
        $kodeQR = $request->input('qr');

        // dd($kodeQR);

        // Memisahkan informasi dari kode QR
        $kd_kelas = substr($kodeQR, 8, 3);
        $kd_mapel = substr($kodeQR, 11, 3);
        $jam_msk = substr($kodeQR, 14, 4);
        $kd_hari = substr($kodeQR, 19, 1);
        $tanggal = substr($kodeQR, 20);

        // dd($kodeQR);
        // Periksa apakah pengguna merupakan anggota dari kd_kelas yang sesuai
        $user = auth()->user();
        $kelas = Master_kelas::where('kd_kelas',$kd_kelas)->pluck('id');
        $memberKelas = Member_kelas::where('siswa_id', $user->id)
            ->where('master_id', $kelas)  
            ->first();

        if ($memberKelas) {
            // Pengguna merupakan anggota dari kd_kelas yang sesuai

            if ($jam_msk < 715) {
                $jam_masuk = '07.00';
                $jam_msk = 700;
                // $status = 'hadir';
            } elseif ($jam_msk >= 700 && $jam_msk < 830) {
                $jam_masuk = '08.30';
                $jam_msk = 830;
                // $status = 'terlambat';
            } elseif ($jam_msk >= 830 && $jam_msk < 1100) {
                $jam_masuk = '10.30';
                $jam_msk = 1030;
            }else {
                $jam_masuk = '08.30';
                $jam_msk = 830;
            }

            // $jamMasukTerlambat = Carbon::createFromFormat('Hi', $jam_masuk)->addMinutes(15);
            $sekarang = intval(str_replace(['.', '-'], '', date('Hi', time())));

            if ($sekarang >= $jam_msk) {
                // Melebihi waktu jam_masuk + 15 menit, tandai sebagai terlambat
                $status = 'terlambat';
            } else {
                // Masih dalam waktu toleransi, tandai sebagai hadir
                $status = 'hadir';
            }

            // Cek apakah sudah ada pemindaian absensi hari ini
            $absensiHariIni = Presensi::where('master_id', $memberKelas->master_id)
                ->where('siswa_id', $user->id)
                ->whereDate('waktu_absen_masuk', today())
                ->first();


            if (!$request->session()->has('scanner_executed')) {
            
                if (!$absensiHariIni) {
                    // Tambahkan data absensi dengan status "tidak hadir"
                    $status = 'tidak hadir';
        
                    Presensi::create([
                        'master_id' => $memberKelas->master_id,
                        'siswa_id' => $user->id,
                        'status' => $status,
                        'point' => - 1,
                        'waktu_absen_masuk' => null,
                        'waktu_absen_pulang' => null,
                    ]);
                } else {
                    // Tambahkan data absensi dengan status sesuai kondisi
                    Presensi::create([
                        'master_id' => $memberKelas->master_id,
                        'siswa_id' => $user->id,
                        'status' => $status,
                        'point' => + 1,
                        'waktu_absen_masuk' => $sekarang,
                        'waktu_absen_pulang' => null,
                    ]);
                }
        
                return response()->json(['message' => 'Sukses! Data absensi ditambahkan.']);
            } else {
                // Pengguna bukan anggota dari kd_kelas yang sesuai
                return response()->json(['message' => 'Pengguna bukan anggota dari kd_kelas.']);
            }
            $request->session()->put('scanner_executed', true);
        }
        // return redirect()->route('masters')->with('success', 'Data member_kelas berhasil ditambahkan.');

    }

//fungsi alfa
    public function scanGuru(Request $request)
    {
        $kodeQR = $request->input('qr');

        // Memisahkan informasi dari kode QR
        $kd_kelas = substr($kodeQR, 8, 3);
        $kd_mapel = substr($kodeQR, 11, 3);
        $jam_msk = substr($kodeQR, 14, 4);
        $kd_hari = substr($kodeQR, 19, 1);
        $tanggal = substr($kodeQR, 20);
        
        // Periksa apakah pengguna merupakan guru dengan kd_mapel yang sesuai
        $user = auth()->user();
        $mapel = Mapel::where('kd_mapel',$kd_mapel)->pluck('id');
        $guru = Guru::where('user_id',$user->id)
                ->where('mapel_id',$mapel)->first();
        // return response()->json(['message' => $user->id]);
        // $guru = Guru::where('user_id', $user->id)
        //     ->whereHas('mapel', function ($query) use ($kd_mapel) {
        //         $query->where('kd_mapel', $kd_mapel);
        //     })
        //     ->get();

        // $guru = Guru::where('mapel_id', function ($query) use ($kd_mapel) {
        //     $query->select('id')->from('mapels')->where('kd_mapel', $kd_mapel);
        // })->first();
        // $guru = Guru::whereHas('mapel', function ($query) use ($kd_mapel) {
        //     $query->where('kd_mapel', $kd_mapel);
        // })->first();
        

        if ($guru) {
            // Pengguna merupakan guru dengan kd_mapel yang sesuai

            // Ambil waktu sekarang
            $sekarang = intval(date('Hi', time()));

            // Periksa status absensi berdasarkan waktu masuk
            if ($sekarang < $jam_msk) {
                // Guru hadir
                $status = 'hadir';
            } elseif ($sekarang >= $jam_msk && $sekarang < ($jam_msk + 15)) {
                // Guru terlambat
                $status = 'terlambat';
            } else {
                // Guru tidak hadir
                $status = 'tidak hadir';
            }

            // Tambahkan data absensi guru
            PresensiGuru::create([
                'guru_id' => $guru->id,
                'status' => $status,
                'point' => ($status == 'hadir') ? 1 : 0,
                'waktu_absen' => now(),
            ]);

            return response()->json(['message' => 'Sukses! Data absensi ditambahkan.']);
        } else {
            // Pengguna bukan guru dengan kd_mapel yang sesuai
            return response()->json(['message' => 'Gagal! Pengguna bukan guru dengan kd_mapel yang sesuai.']);
        }
    }


    public function store(StoreAbsenRequest $request)
    {
        //
    }

    public function show(Absen $absen)
    {
        //
    }

    public function edit(Absen $absen)
    {
        //
    }

    public function update(UpdateAbsenRequest $request, Absen $absen)
    {
        //
    }

    public function destroy(Absen $absen)
    {
        //
    }
}
