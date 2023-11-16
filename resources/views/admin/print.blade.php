<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Laporan Absensi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style type="text/css">
		.container {
			margin: 0 auto;
			padding: 20px;
			width: 800px;
			/* height: 1100px; */
			background-color: #fff;
			border: 1px solid #000;
			box-sizing: border-box;
		}
		.logo {
			width: 150px;
			height: 150px;
			margin: 0 auto;
			margin-bottom: 20px;
		}
		.nama-perusahaan {
			font-size: 24px;
			font-weight: bold;
			text-align: center;
			margin-bottom: 20px;
		}
		.alamat {
			font-size: 14px;
			text-align: center;
			margin-bottom: 20px;
		}
		.line {
			border-top: 2px solid #000;
			margin-bottom: 20px;
		}
		.keterangan {
			font-size: 14px;
			margin-bottom: 20px;
		}
	</style>
</head>
<body onload="window.print();">
	<div class="container">
		<img src="https://dummyimage.com/150x80/800000/ffffff.png&text=SMK+Sirajul+falah" alt="Logo">
		<div class="nama-perusahaan">Laporan Absensi Siswa Kelas {{ $masters->nm_kelas }}</div>
		<div class="alamat">Jl. H. Mawi RT. 02/01 No. 42, Bojong Indah, Kec. Parung, Kab. Bogor Prov. Jawa Barat</div>
		<div class="line"></div>
		<div class="keterangan">
			<div class="table-responsive">    
                <table id="print-document" class="table table-bordered data-table">
                    <thead>
                        <tr>
							<th>No</th>
                            <th>Nim Siswa</th>
                            <th>Nama Siswa</th>
                            <th>Hadir</th>
                            <th>Izin</th>
                            <th>Tidak Hadir</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tbody>
						<?php $no = 0 ?>
                        @foreach($members as $member)
                            <?php $no++ ;?>
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $member->siswa->nim_murid }}</td>
                                <td>{{ $member->siswa->name }}</td>
                                <td>{{ $presensis->where('siswa_id', $member->siswa->id)->where('status', 'hadir')->count() }}</td>
								<td>{{ $presensis->where('siswa_id', $member->siswa->id)->where('status', 'izin')->count() }}</td>
								<td>{{ $presensis->where('siswa_id', $member->siswa->id)->where('status', 'tidak hadir')->count() }}</td>
        
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
		</div>
	</div>
    
    <script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/datatables-demo.js"></script>
</body>
</html>
