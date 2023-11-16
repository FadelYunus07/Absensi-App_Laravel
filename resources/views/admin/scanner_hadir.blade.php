@extends('layout.auth.app',[
    'title' => 'Presensi Kehadiran'
])
@section('content')
<div class="row justify-content-center">

    <div class="col-xl-5 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            {{-- <p>{{ auth()->user()->id }}</p> --}}
                            <div id="qr-reader"></div>
                            <div id="qr-reader-results"></div>
                                                    
                        </div>
                        {{-- <div class="p-5">
                            <p>Isi Lengkapi Form dibawah apabila izin</p>
                            <form method="POST" action="{{ route('guru.submit_izin') }}" enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <label for="alasan">Alasan tidak dapat hadir:</label>
                                    <textarea id="alasan" name="alasan" required></textarea>
                                </div>
                                <div>
                                    <label for="bukti">Bukti surat dokter:</label>
                                    <input type="file" id="bukti" name="bukti" required>
                                </div>
                                <div>
                                    <button type="submit">Kirim</button>
                                </div>
                            </form>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script src="https://rawgit.com/mebjas/html5-qrcode/master/html5-qrcode.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>
<script>
    let scanningEnabled = true;

    function onScanSuccess(qrCode) {
        if (scanningEnabled) {
            scanningEnabled = false; // Menonaktifkan pemindaian setelah mendapatkan hasil pertama

            // Mendapatkan posisi GPS perangkat pengguna
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;


                // Mengarahkan URL berdasarkan jenis pengguna (akun guru atau akun siswa)
                var url = '';
                var userRole = '{{ Auth::user()->role }}'; // Ambil peran pengguna dari PHP (misalnya dari session)

                if (userRole === 'guru') {
                    url = '{{ route("scanhdrGuru") }}';
                } else if (userRole === 'siswa') {
                    url = '{{ route("scanhdrSiswa") }}';
                }

                // Mengirimkan posisi GPS dan QR Code ke server
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        qrCode: qrCode,
                        latitude: latitude,
                        longitude: longitude
                    },
                    success: function(response) {
                        alert(response.message);
                        html5QrcodeScanner.clear();
                        window.location.href = '{{ route("dash") }}';
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseText);
                    }
                });
            });
        }
    }

    function onScanFailure(error) {
        console.warn('QR error = ' + error);
    }

    const html5QrcodeScanner = new Html5QrcodeScanner(
        'qr-reader',
        { fps: 10, qrbox: 250 },
        false
    );

    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>

    
@stop