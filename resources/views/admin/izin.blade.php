@extends('layout.backend.app',[
    'title' => 'Manage Admin',
    'pageTitle' =>'Manage Admin',
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
                
        </div>
        </div>
            <div class="card-body">


        </div>
</div>



@stop

@push('js')
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/datatables-demo.js"></script>
