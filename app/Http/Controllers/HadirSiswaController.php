<?php

namespace App\Http\Controllers;

use App\Services\TelegramService;
use App\Models\Hadir_siswa;
use App\Models\Member_kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreHadir_siswaRequest;
use App\Http\Requests\UpdateHadir_siswaRequest;

class HadirSiswaController extends Controller
{
    protected $telegramService;

    public function index()
    {
        
        return view('admin.scanner_hadir');

    }

    public function scanhdrSiswa(Request $request)
    {
        // Ambil data QR Code dari request
        $qrCode = $request->input('qrCode');
        $user = Auth::user();
        $siswa = $user->siswa;
        $member = Member_kelas::where('siswa_id',$siswa->id)->first();

        // Parse data QR Code (latitude, longitude, radius)
        $qrData = explode(',', $qrCode);
        $latitude = $qrData[0];
        $longitude = $qrData[1];
        $radius = $qrData[2];

        $tanggalHariIni = now()->format('Y-m-d');

        // Cek apakah ada pencatatan kehadiran dengan tanggal yang sama
        
        // Cek lokasi pengguna
        $userLatitude = $request->input('latitude');
        $userLongitude = $request->input('longitude');
        
        // Cek apakah ada pencatatan kehadiran dengan jam_pulang null
        $kehadiran = Hadir_siswa::where('siswa_id', $siswa->id)
        ->whereNull('jam_pulang')
        ->first();
        
        $absenHariIni = Hadir_siswa::where('siswa_id', $siswa->id)
            ->whereDate('jam_masuk', $tanggalHariIni)
            ->first();

        if ($kehadiran) {
        // Dapatkan chat ID orang tua siswa berdasarkan nomor telepon
        // $noWali = '+6285774179312'; // Nomor telepon orang tua siswa
        // $chatId = $telegramService->getChatIdByPhoneNumber($noWali);

        // // Kirim pesan ke chat ID orang tua siswa
        // $message = "Anak Anda telah pulang dari sekolah.";
        // $telegramService->sendMessage($chatId, $message);

            $kehadiran->update([
                'jam_pulang' => now(),
                'koordinate_pulang' => json_encode([$userLatitude, $userLongitude])
            ]);

            return response()->json(['message' => 'Scan pulang berhasil']);
        } elseif ($this->haversineDistance($userLatitude, $userLongitude, $latitude, $longitude, $radius)) {
            if ($absenHariIni) {
                return response()->json(['message' => 'Anda telah absen hari ini']);
            }
            
            // Tambahkan data kehadiran baru dengan scan masuk
            Hadir_siswa::create([
                'member_id' => $member->id,
                'siswa_id' => $siswa->id,
                'jam_masuk' => now(),
                'jam_pulang' => null,
                'koordinate_masuk' => json_encode([$userLatitude, $userLongitude]),
                'koordinate_pulang' => null
            ]);

                    // Dapatkan chat ID orang tua siswa berdasarkan nomor telepon
            // $noWali = '+6285774179312'; // Nomor telepon orang tua siswa
            // $chatId = $telegramService->getChatIdByPhoneNumber($noWali);

            // // Kirim pesan ke chat ID orang tua siswa
            // $message = "Anak Anda telah masuk sekolah.";
            // $telegramService->sendMessage($chatId, $message);
            
            return response()->json(['message' => 'Absen Hadir Berhasil']);
        } else {
            return response()->json(['message' => 'Lokasi tidak valid']);
        }
    }

    function haversineDistance($latitude1, $longitude1, $latitude2, $longitude2, $radius)
    {
        // Konversi ke radian
        $latitude1 = deg2rad($latitude1);
        $longitude1 = deg2rad($longitude1);
        $latitude2 = deg2rad($latitude2);
        $longitude2 = deg2rad($longitude2);

        // Perbedaan latitude dan longitude
        $deltaLatitude = $latitude2 - $latitude1;
        $deltaLongitude = $longitude2 - $longitude1;

        // Haversine formula
        $a = sin($deltaLatitude / 2) * sin($deltaLatitude / 2) + cos($latitude1) * cos($latitude2) * sin($deltaLongitude / 2) * sin($deltaLongitude / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $c;

        // Jarak kurang dari atau sama dengan radius
        if ($distance <= $radius) {
            return true;
        } else {
            return false;
        }
    }

    public function laporanSiswa()
    {
        $siswas = Hadir_siswa::with('siswa')->get();
        // $member = Hadir_siswa::with('siswa')->pluck('master_id');
        // dd($member);
        // $master = Master_kelas::where('id',$member)->first();
        return view('admin.presensi_hadir_siswa', compact('siswas'));
    }

    public function downloadHadirSiswaPDF()
    {
        // Ambil semua presensi guru dan presensi
        $hadirs = Hadir_siswa::with('siswa')->get();
        return view('admin.print_hdrSiswa', compact('hadirs'));
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
     * @param  \App\Http\Requests\StoreHadir_siswaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHadir_siswaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hadir_siswa  $hadir_siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Hadir_siswa $hadir_siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hadir_siswa  $hadir_siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Hadir_siswa $hadir_siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHadir_siswaRequest  $request
     * @param  \App\Models\Hadir_siswa  $hadir_siswa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHadir_siswaRequest $request, Hadir_siswa $hadir_siswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hadir_siswa  $hadir_siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hadir_siswa $hadir_siswa)
    {
        //
    }
}
