@extends('layout.backend.app',[
	'title' => 'Welcome',
	'pageTitle' => 'Dashboard',
])
@section('content')
<div class="jumbotron">
  @if (Auth::user()->role == 'admin')
    <p>Selamat datang, {{ Auth::user()->admin->name }}</p>
    <p class="lead">Ini adalah halaman simple dashboard.</p>
    <hr class="my-4">
    <p>Anda login sebagai {{ Auth::user()->role }}.</p>
  @elseif (Auth::user()->role == 'guru')
    <p>Selamat datang, {{ Auth::user()->guru->name }}</p>
    <p class="lead">Ini adalah halaman simple dashboard.</p>
    <hr class="my-4">
    <p>Anda login sebagai {{ Auth::user()->role }}.</p>
  @else
    <p>Selamat datang, {{ Auth::user()->siswa->name }}</p>
    <p class="lead">Ini adalah halaman simple dashboard.</p>
    <hr class="my-4">
    <p>Anda login sebagai {{ Auth::user()->role }}.</p>
  @endif
</div>
@endsection