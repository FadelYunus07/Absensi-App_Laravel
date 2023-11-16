@extends('layout.backend.app',[
    'title' => 'Manage Jadwal',
    'pageTitle' =>'Manage Jadwal',
])

@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="notify"></div>

<div class="card">
    <div class="card-header">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
            Tambah Data
        </button>
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
                    <form action="{{ route('jadwals.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_karyawan">No Karyawan</label>
                            <input type="text" class="form-control" id="no_karyawan" name="no_karyawan" placeholder="isi No Karyawan">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            <p class="h1">Kelas {{ $master->nm_kelas }}</p>
            <div class="table-responsive">    
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Mapel</th>
                            <th>Nama Mapel</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Hari</th>
                            {{-- <th>Presensi Status</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tbody>
                        @php
                            $no = ($jadwals->currentPage() - 1) * $jadwals->perPage() + 1;
                        @endphp
                        @foreach($jadwals as $jadwal)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $jadwal->mapel->kd_mapel }}</td>
                                <td>{{ $jadwal->mapel->nm_mapel }}</td>
                                {{-- <td>{{ $jadwal->matkul->jml_sks }}</td> --}}
                                <td>{{ $jadwal->jam_masuk }}</td>
                                <td>{{ $jadwal->jam_pulang }}</td>
                                <td>{{ $jadwal->hari }}</td>
                                {{-- <td>{{ $jadwal->presensi->dosen_id }}</td> --}}
                                <td>
                                    <a href="{{ route('jadwals.edit', $jadwal->id) }}" class="btn btn-primary btn-sm ml-2 btn-edit">Edit</a>
                                    <form action="{{ route('jadwals.destroy', $jadwal->id) }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm ml-2 btn-edit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        {{ $jadwals->links() }}
                    </tbody>
                </table>
            </div>
        </div>
</div>



@stop

@push('js')
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/datatables-demo.js"></script>
