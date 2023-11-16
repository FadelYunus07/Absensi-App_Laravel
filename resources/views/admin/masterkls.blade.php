@extends('layout.backend.app',[
    'title' => 'Manage Master Kelas',
    'pageTitle' =>'Manage Master Kelas',
])

@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="notify"></div>

<div class="card">
    <div class="card-header">
        <!-- Button trigger modal -->
        

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
                    <form action="{{ route('masters.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="kd_kelas">Kode Kelas</label>
                            <input type="text" class="form-control" id="kd_kelas" name="kd_kelas" required>
                        </div>
                        <div class="mb-3">
                            <label for="nm_kelas">Nama Kelas</label>
                            <input type="text" class="form-control" id="nm_kelas" name="nm_kelas" required>
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
            {{-- <p>{{ auth()->user()->id }}</p> --}}
            <div class="table-responsive">    
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Kelas</th>
                            <th>Tombol tambah kelas</th>
                            <th>Nama Kelas</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tbody>
                        @php
                            $no = ($masteres->currentPage() - 1) * $masteres->perPage() + 1;
                        @endphp
                        @foreach($masteres as $kelas)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $kelas->kd_kelas }}</td>
                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                                    Tambah Data
                                </button></td>
                                <td>{{ $kelas->nm_kelas }}</td>
                                <td>
                                    <a href="{{ route('members', $kelas->id) }}" class="btn btn-warning btn-sm ml-2 btn-edit">Member Kelas</a>
                                    <a href="{{ route('jadwals', $kelas->id) }}" class="btn btn-secondary btn-sm ml-2 btn-edit">Jadwal Kelas</a>
                                    {{-- <a href="{{ route('presensikls', $kelas->id) }}" class="btn btn-primary btn-sm ml-2 btn-edit">Presensi </a> --}}
                                    <a href="{{ route('presensi', $kelas->id) }}" class="btn btn-primary btn-sm ml-2 btn-edit">QR Presensi Kelas</a>
                                    <a href="{{ route('presensiKls', $kelas->id) }}" class="btn btn-primary btn-sm ml-2 btn-edit">Absensi</a>
                                    <a href="{{ route('presensi.pdf', $kelas->id) }}" class="btn btn-primary btn-sm ml-2 btn-edit">Cetak</a>
                                    <form action="{{ route('masters.destroy', $kelas->id) }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm ml-2 btn-edit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        {{ $masteres->links() }}
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
