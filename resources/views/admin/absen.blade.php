@extends('layout.auth.app',[
    'title' => 'Absen'
])
@section('content')
<div class="row justify-content-center m-0">
    <div class="col-xl-4">
        <div class="card o-hidden border-0 shadow-lg my-3">
            <div class="p-3">
                <div class="text-center px-1">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                    <p>Scan QR code ini untuk melakukan presensi</p>
                    <img src="data:image/png;base64,{{base64_encode($qrCodes)}}" alt="QR Code">
                    <h2 class="h4 text-gray-900 mt-3">Kode Kelas: {{ $master->nm_kelas }}</h2>
                    <h2 class="h4 text-gray-900">Jam Masuk: {{ $jam_masuk }}</h2>
                    <h2 class="h4 text-gray-900">Tanggal: {{ $tanggal }}</h2>
                    <h2 class="h4 text-gray-900">Mapel: {{ $mapel->nm_mapel }}</h2>
                </div>                            
            </div>
        </div>
    </div>
</div>
    