@extends('layout.backend.app',[
    'title' => 'Laporan Kehadiran Guru',
    'pageTitle' =>'Laporan Kehadiran Guru',
])

@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="notify"></div>

<div class="card">
    <div class="card-header">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
            Tambah Data
        </button>

        <a href="{{ route('hdrGuru.pdf') }}" class="btn btn-primary">
            <span>Cetak Kehadiran Guru</span>
        </a>
        

        {{-- <button type="button" id="btn-refresh" class="btn btn-primary">Refresh Status</button> --}}

        <!-- Modal -->
        <div class="modal fade" id="addModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="guru_id">Pilih Siswa</label>
                                <select class="form-control" id="guru_id" name="guru_id">
                                <!-- Looping untuk menampilkan opsi siswa -->
                                @foreach($gurus as $guru)
                                    <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <!-- Tambahkan input fields lainnya sesuai kebutuhan -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="card-body">
            {{-- <p class="h3">Kelas {{ $mstr->nm_kelas }} </p> --}}
            {{-- <p>{{ $hari }} {{ $tanggal }}</p> --}}
            <div class="table-responsive">    
                <table id="print-document" class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Guru</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Koordinate Pengguna Masuk</th>
                            <th>Koordinate Pengguna Pulang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($gurus as $guru)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $guru->guru->name }}</td>
                            <td>{{ $guru->jam_masuk}}</td>
                            <td>{{ $guru->jam_pulang}}</td>
                            <td>{{ $guru->koordinate_gps_masuk}}</td>
                            <td>{{ $guru->koordinate_gps_pulang}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>
@endsection

@push('js')

<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/datatables-demo.js"></script>
@endpush
