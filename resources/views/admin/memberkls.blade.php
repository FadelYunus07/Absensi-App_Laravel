@extends('layout.backend.app',[
    'title' => 'Manage Member Kelas',
    'pageTitle' =>'Manage Member Kelas',
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
                        <form action="{{ route('members.store') }}" method="POST">
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
                                <label for="master_id">Pilih Siswa</label>
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
            <p class="h1">Kelas {{ $mstr->nm_kelas }}</p>
            <div class="table-responsive">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nim Siswa</th>
                            <th>Nama Siswa</th>
                            <th>Gender</th>
                            <th>Tahun Ajaran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tbody>
                        <?php $no = ($members->currentPage() - 1) * $members->perPage() + 1; ?>
                        @foreach($members as $member)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $member->siswa->nim_murid }}</td>
                                <td>{{ $member->siswa->name }}</td>
                                <td>{{ $member->siswa->gender }}</td>
                                <td>{{ $member->siswa->thn_ajaran }}</td>
                                <td>
                                    <a href="{{ route('members.edit', $member->id) }}" class="btn btn-primary btn-sm ml-2 btn-edit">Edit</a>
                                    <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm ml-2 btn-edit">Delete</button>
                                    </form>
                                </td>
                            </tr>                    
                        @endforeach
                        {{ $members->links() }}
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
