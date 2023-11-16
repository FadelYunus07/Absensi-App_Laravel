<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hadir;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HadirController extends Controller
{

    public function index()
    {
        // $nm_tempat = $request->input('nm_tempat');
        $hadir = Hadir::where('nm_tempat', 'rumah')->first();

        // dd($hadir);
        if (!$hadir) {
            return back()->with('error', 'Tempat tidak ditemukan');
        }

        $qrCode = QrCode::format('png')->size(200)->generate("{$hadir->latitude},{$hadir->longitude},{$hadir->radius}");
        return view('admin.kehadiran', compact('hadir','qrCode'));
    }


    private function isWithinRadius($latitude, $longitude, $radius)
    {
        // Implementasikan logika untuk pengecekan koordinat pengguna dalam radius tertentu
        // Anda dapat menggunakan formula Haversine atau metode lainnya untuk menghitung jarak antara dua koordinat
        // Contoh sederhana menggunakan perhitungan jarak Euclidean
        $qrLatitude = -6.123456; // Koordinat latitude QR Code
        $qrLongitude = 106.123456; // Koordinat longitude QR Code

        // -6.337842392028075, 106.72461038040709

        $distance = sqrt(pow($latitude - $qrLatitude, 2) + pow($longitude - $qrLongitude, 2));

        return $distance <= $radius;
    }

    public function downloadQR(Request $request)
    {
        $hadir = Hadir::where('nm_tempat', 'rumah')->first();

        if (!$hadir) {
            return back()->with('error', 'Tempat tidak ditemukan');
        }

        $qrCode = QrCode::format('png')->size(200)->generate("{$hadir->latitude},{$hadir->longitude},{$hadir->radius}");

        $response = Response::make($qrCode, 200);
        $response->header('Content-Type', 'image/png');
        $response->header('Content-Disposition', 'attachment; filename="qr_code.png"');

        return $response;
    }

}
