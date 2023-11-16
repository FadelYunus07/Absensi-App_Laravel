@extends('layout.backend.app',[
    'title' => 'Manage Siswa',
    'pageTitle' =>'Manage Siswa',
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
                    <form action="{{ route('siswa.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="nim_murid">NIS Siswa</label>
                            <input type="text" class="form-control" id="nim_murid" name="nim_murid" placeholder="isi Nim Siswa">
                        </div>
                        <div class="mb-3">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="Pria">Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
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
                            <th>Nim Siswa</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tbody>
                        @php
                            $no = ($siswas->currentPage() - 1) * $siswas->perPage() + 1;
                        @endphp
                        @foreach($siswas as $siswa)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $siswa->nim_murid }}</td>
                                <td>{{ $siswa->name }}</td>
                                <td>{{ $siswa->gender }}</td>
                                <td>
                                    <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-primary btn-sm ml-2 btn-edit">Edit</a>
                                    <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm ml-2 btn-edit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        {{ $siswas->links() }}
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
