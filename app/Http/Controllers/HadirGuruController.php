<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Hadir;

use App\Models\Hadir_guru;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreHadir_guruRequest;
use App\Http\Requests\UpdateHadir_guruRequest;

class HadirGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.scanner_hadir');

    }

    public function scanhdrGuru(Request $request)
    {
        // Ambil data QR Code dari request
        $qrCode = $request->input('qrCode');
        $user = Auth::user();
        $guru = $user->guru;

        // Parse data QR Code (latitude, longitude, radius)
        $qrData = explode(',', $qrCode);
        $latitude = $qrData[0];
        $longitude = $qrData[1];
        $radius = $qrData[2];

        // Cek lokasi pengguna
        $userLatitude = $request->input('latitude');
        $userLongitude = $request->input('longitude');

        // Cek apakah ada pencatatan kehadiran dengan jam_pulang null
        $kehadiran = Hadir_guru::where('guru_id', $guru->id)
            ->whereNull('jam_pulang')
            ->first();

        // Ambil tanggal hari ini
        $tanggalHariIni = now()->format('Y-m-d');

        // Cek apakah ada pencatatan kehadiran dengan tanggal yang sama
        $absenHariIni = Hadir_guru::where('guru_id', $guru->id)
            ->whereDate('jam_masuk', $tanggalHariIni)
            ->first();

            
            
            if ($kehadiran) {
                // Update data kehadiran dengan scan pulang
                $kehadiran->update([
                    'jam_pulang' => now(),
                    'koordinate_gps_pulang' => json_encode([$userLatitude, $userLongitude])
                ]);
                
                return response()->json(['message' => 'Scan pulang berhasil']);
            } elseif ($this->haversineDistance($userLatitude, $userLongitude, $latitude, $longitude, $radius)) {
            // Tambahkan data kehadiran baru dengan scan masuk
            if ($absenHariIni) {
                return response()->json(['message' => 'Anda telah absen hari ini']);
            }
            Hadir_guru::create([
                'guru_id' => $guru->id,
                'jam_masuk' => now(),
                'jam_pulang' => null,
                'koordinate_gps_masuk' => json_encode([$userLatitude, $userLongitude]),
                'koordinate_gps_pulang' => null
            ]);

            //'Scan masuk berhasil'
            // $distance = $this->haversineDistance($userLatitude, $userLongitude, $latitude, $longitude, $radius);
            return response()->json(['message' => 'Scan masuk berhasil']);
        } else {
            return response()->json(['message' => 'Lokasi tidak valid']); 
        }
    }

/**
 * Menghitung jarak antara dua titik koordinat menggunakan haversine formula.
 *
 * @param float $latitude1 Latitude titik koordinat pertama.
 * @param float $longitude1 Longitude titik koordinat pertama.
 * @param float $latitude2 Latitude titik koordinat kedua.
 * @param float $longitude2 Longitude titik koordinat kedua.
 * @param float $radius Radius jangkauan.
 * @return bool True jika jarak kurang dari atau sama dengan radius, false jika tidak.
 */
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

        // return $latitude1;
        // echo "Nilai distance: " . $distance . PHP_EOL;

        // Jarak kurang dari atau sama dengan radius
        if ($distance <= $radius) {
            return true;
        } else { 
            return false;
        }
    }

    public function laporanGuru()
    {
        $gurus = Hadir_guru::with('guru')->get();
        return view('admin.presensi_hadir_guru', compact('gurus'));
    }

    public function downloadHadirGuruPDF()
    {
        // Ambil semua presensi guru dan presensi
        $hadirs = Hadir_guru::with('guru')->get();
        $absen = $hadirs->groupBy('guru_id')->count();
        // foreach ($hadirs as $hadir) {
            // }
        // dd($absen);
        return view('admin.print_hdrGuru', compact('hadirs','absen'));
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHadir_guruRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHadir_guruRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hadir_guru  $hadir_guru
     * @return \Illuminate\Http\Response
     */
    public function show(Hadir_guru $hadir_guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hadir_guru  $hadir_guru
     * @return \Illuminate\Http\Response
     */
    public function edit(Hadir_guru $hadir_guru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHadir_guruRequest  $request
     * @param  \App\Models\Hadir_guru  $hadir_guru
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHadir_guruRequest $request, Hadir_guru $hadir_guru)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hadir_guru  $hadir_guru
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hadir_guru $hadir_guru)
    {
        //
    }
}
