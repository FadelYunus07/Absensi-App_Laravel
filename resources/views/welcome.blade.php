<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap-4/css/bootstrap.min.css') }}">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="/">CHIKADMIN</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
      	@auth
      		<a class="nav-link" href="{{ route('dash') }}">Dashboard</a>
      	@else
      		<a class="nav-link" href="{{ route('login') }}">Login</a>
      	@endauth
      </li>
    </ul>
    <span class="navbar-text">

    </span>
  </div>
</nav>

<div class="container-fluid mt-5">
	
	<div class="jumbotron">
    @guest
    <h1 class="display-4">Selamat Datang di WEB Absensi SMK Sirajul Falah</h1>
    @endguest

    @auth
    <h1 class="display-4">Hello , {{ Auth::user()->name }}</h1>
    @endauth
    
    {{-- <p class="lead">WEB Absensi adalah simpel starter sb-admin-2 untuk laravel, keuntungannya adalah kita tidak harus mengintegrasikan sb-admin-2 dari awal.</p>
	  <hr class="my-4"> --}}

    <div class="row">
      
      <div class="col-lg-6 mb-3">
        <div class="card">
          <div class="card-header">
            Contoh No Induk & Password Login untuk memudahkan testing
          </div>

          <div class="card-body">
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">No Induk</th>
                  <th scope="col">Password</th>
                  <th scope="col">Role</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>741611</td>
                  <td>password</td>
                  <td>admin</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>37211213</td>
                  <td>password</td>
                  <td>guru</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>10213372</td>
                  <td>password</td>
                  <td>siswa</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<script type="text/javascript" src="{{ asset('plugins/bootstrap-4/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/bootstrap-4/js/bootstrap.min.js') }}"></script>
</body>
</html>