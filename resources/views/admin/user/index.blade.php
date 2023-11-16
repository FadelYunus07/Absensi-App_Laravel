@extends('layout.backend.app',[
    'title' => 'Manage User',
    'pageTitle' =>'Manage User',
])

@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="notify"></div>

<div class="card">
    <div class="card-header">
    <!-- Button trigger modal -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                          <th>#</th>
                          <th>Role</th>
                          <th>Name</th>
                          <th>No Karyawan/Kode Guru/Nim Murid</th>
                          <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tbody>
                        @php
                            $urut = 1;
                            $no = ($users->currentPage() - 1) * $users->perPage();
                        @endphp 
                        @foreach($users as $user)
                            <tr>
                              <td>{{ $user->id}}</td>
                              <td>{{ $user->role }}</td>
                              @if ($user->role == 'admin')
                              <td>{{ $user->admin->name ?? '' }}</td>
                              <td>{{ $user->admin->no_karyawan ?? '' }}</td>
                              @elseif ($user->role == 'guru')
                              <td>{{ $user->guru->name ?? '' }}</td>
                              <td>{{ $user->guru->kd_guru ?? ''}}</td>
                              @else
                              <td>{{ $user->siswa->name ?? '' }}</td>
                              <td>{{ $user->siswa->nim_murid ?? ''}}</td>
                              @endif
                              <td>
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-sm ml-2 btn-edit">Edit</a>
                                <form action="{{ route('kelolaUser.destroyed', $user->id) }}" method="POST" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm ml-2 btn-edit">Delete</button>
                                </form>
                            </td>                            
                            </tr>
                        @endforeach
                        {{ $users->links() }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@push('js')
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/datatables-demo.js"></script>
@endpush