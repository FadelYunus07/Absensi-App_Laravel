@extends('layout.auth.app',[
    'title' => 'Absen Hadir'
])
@section('content')
<div class="row justify-content-center m-0">
    <div class="col-xl-4">
        {{-- <form action="{{ route('generate-qr') }}" method="POST">
            @csrf
    
            <label for="nm_tempat">Pilih Tempat</label>
            <select name="nm_tempat" id="nm_tempat">
                @foreach ($tempats as $tempats)
                    <option value="{{ $tempats->nm_tempat }}">{{ $tempats->nm_tempat }}</option>
                @endforeach
            </select>
    
            <button type="submit">Generate QR Code</button>
        </form> --}}
        <div class="card o-hidden border-0 shadow-lg my-3">
            <div class="p-3">
                <div class="text-center px-1">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                    <p>Scan QR code ini untuk melakukan presensi Kehadiran</p>
                {{-- @if (isset($qrCode)) --}}
                    <img class="m-3" src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code">
                    <p>Latitude : {{ $hadir->latitude }}</p>
                    <p>Longitude : {{ $hadir->longitude }}</p>
                    <p>Radius : {{ $hadir->radius }} KM</p>
                {{-- @endif --}}
                    <a href="{{ route('download-qr') }}" class="btn btn-primary btn-sm ml-2 btn-edit">Unduh QR Code</a>
                </div>                            
            </div>
        </div>
    </div>
</div>
