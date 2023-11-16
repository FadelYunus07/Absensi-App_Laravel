<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "absen-guru";

$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$sql="insert into master_qrs(qr, created_at) SELECT concat(mk.kd_kelas, m.kd_mapel, date_format(jam_masuk,'%H%i'), hari, date_format(CURRENT_DATE(),'%Y%m%d')), str_to_date(concat(CURRENT_DATE, jam_masuk),'%Y-%m-%d %H:%i')
from jadwals j
join master_kelas mk on mk.id=j.kelas_id
join mapels m on m.id=j.mapel_id
where hari=2";
mysqli_query($con, $sql);

?>