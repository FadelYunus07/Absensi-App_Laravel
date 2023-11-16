@extends('layout.backend.app',[
    'title' => 'Laporan Absensi Siswa',
    'pageTitle' =>'Laporan Absensi Siswa',
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
                        <form action="{{ route('presensi.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="siswa_id">Pilih Siswa</label>
                                <select class="form-control" id="siswa_id" name="siswa_id">
                                <!-- Looping untuk menampilkan opsi siswa -->
                                @foreach($siswas as $siswa)
                                    <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="master_id">Pilih Kelas</label>
                                <select class="form-control" id="master_id" name="master_id">
                                <!-- Looping untuk menampilkan opsi siswa -->
                                @foreach($masters as $master)
                                    <option value="{{ $master->id }}">{{ $master->nm_kelas }}</option>
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
            <p class="h3">Kelas {{ $mstr->nm_kelas }} </p>
            <p>{{ $hari }} {{ $tanggal }}</p>
            <div class="table-responsive">    
                <table id="print-document" class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Status</th>
                            <th>Mapel</th>
                            <th>Waktu Scan Masuk</th>
                            <th>Waktu Scan Selesai</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($presensis as $presensi)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $presensi->siswa->name }}</td>
                            <td>{{ $presensi->status}}</td>
                            <td>{{ $mapel->nm_mapel}}</td>
                            <td>{{ $presensi->waktu_absen_masuk}}</td>
                            <td>{{ $presensi->waktu_absen_pulang}}</td>
                            <td>
                                <form action="{{ route('presensikls.update', $presensi->id) }}" method="POST" class="d-inline">
                                    @method('PATCH')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm ml-2 btn-edit">Ganti Status</button>
                                </form>
                                
                            </td>
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
