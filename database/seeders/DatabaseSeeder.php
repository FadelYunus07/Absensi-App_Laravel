<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Guru;
use App\Models\User;
use App\Models\Admin;
use App\Models\Jadwal;
use App\Models\Matkul;
use App\Models\Presensi;
use App\Models\Mahasiswa;
use App\Models\MasterKelas;
use App\Models\MemberKelas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Illuminate\Auth\Authenticatable;



class DatabaseSeeder extends Seeder
{
    
    /**
     * Seed the application's database.
     *
     * @return void
     */

     public function run()
     {
         $faker = Factory::create();
 
        // Create users
        // for ($i = 0; $i < 10; $i++) {
        //     User::create([
        //         'password' => bcrypt('password'),
        //         'role' => 'admin'
        //     ]);
        //     User::create([
        //         'password' => bcrypt('password'),
        //         'role' => 'guru'
        //     ]);
        //     User::create([
        //         'password' => bcrypt('password'),
        //         'role' => 'siswa'
        //     ]);
        // }

        // Create admins
        // $users = User::where('role', 'admin')->get();
        // foreach ($users as $user) {
        //     Admin::create([
        //         'name' => $faker->name,
        //         'no_karyawan' => $faker->unique()->randomNumber($nbDigits = 6),
        //         'user_id' => $user->id
        //     ]);
        // }
        
        // // Create guru
        // $users = User::where('role', 'guru')->get();
        // foreach ($users as $user) {
        //     Guru::create([
        //         'name' => $faker->name,
        //         'kd_guru' => $faker->unique()->randomNumber($nbDigits = 6),
        //         'user_id' => $user->id
        //     ]);

        // }
        // Create Siswa
        $users = User::where('role', 'siswa')->get();
        // $kd_kelas = ['01TPLP001', '01TPLP002', '01TPLP003', '02TPLP001', '02TPLP002', '02TPLP003', '03TPLP001','03TPLP002' ,'03TPLP003', '03TPLP004'];
        foreach ($users as $user) {
            DB::table('siswas')->insert([
                'kd_kelas' => $faker->randomElement(['7A', '7B', '7C', '8A', '8B', '8C','9A' ,'9B', '9C']),
                'nim_murid' => $faker->unique()->numberBetween(1000, 9999),
                'name' => $faker->name,
                'gender' => $faker->randomElement(['Pria', 'Wanita']),
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);

        }
        
        // $users = User::where('role', 'guru')->get();
        // $gurus = DB::table('gurus')->pluck('id')->toArray();
        // foreach ($gurus as $guru) {
        //     Presensi::create([
        //         'id_guru' => $guru,
        //         'waktu_absen' => $faker->dateTimeBetween('-1 week', 'now'),
        //         'status' => $faker->randomElement(['hadir','absen','ijin'])
        //     ]);
        // }
        
        // $masters = DB::table('master_kelas')->pluck('id')->toArray();
        // foreach ($masters as $guru) {
        //     Presensi::create([
        //         'id_guru' => $guru,
        //         'waktu_absen' => $faker->dateTimeBetween('-1 week', 'now'),
        //         'status' => $faker->randomElement(['hadir','absen','ijin'])
        //     ]);
        // }

        // // Create Mahasiswa
        // for ($i = 0; $i < 10; $i++) {
        //     Mahasiswa::create([
        //         'nim_mhs' => $faker->numberBetween($min = 111111111111, $max = 999999999999),
        //         'name' => $faker->name,
        //         'gender' => $faker->randomElement(['Pria', 'Wanita']),
        //     ]);
        // }           
        
        // // Create matkul
        // $mks = ['Kalkulus 1', 'Kalkulus 2', 'Fisika 1', 'Fisika 2', 'Algoritma Dasar', 'Interaksi Manusia dengan Internet', 'Matematika Dekrit','Statistika Dasar' ,'Etika Profesi', 'Logika Informatika'];
        // foreach ($mks as $mk) {
        //     Matkul::create([
        //         'kd_mk' => $faker->unique()->numberBetween($min = 1000, $max = 9999),
        //         'nama_mk' => $mk,
        //         'jml_sks' => $faker->numberBetween($min = 2, $max = 3)
        //     ]);
        // }
        
        // // Create Master Kelas
        // // seed data master_kelas
        // $kd_kelas = ['01TPLP001', '01TPLP002', '01TPLP003', '02TPLP001', '02TPLP002', '02TPLP003', '03TPLP001','03TPLP002' ,'03TPLP003', '03TPLP004'];
        // foreach ($kd_kelas as $kelas) {
        //     DB::table('master_kelas')->insert([
        //         'kd_kelas' => $kelas,
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ]);
        // }

        // seed data mahasiswa
        // $users = User::where('role', 'siswa')->get();
        // for ($i = 0; $i < 10; $i++) {
        //     DB::table('siswas')->insert([
        //         'nim_murid' => $faker->unique()->numberBetween(1000, 9999),
        //         'name' => $faker->name,
        //         'gender' => $faker->randomElement(['Pria', 'Wanita']),
        //         'user_id' => $users->id,
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ]);
        // }

        // seed data member_kelas
        // seed data member_kelas
        // $siswa = DB::table('siswas')->pluck('id')->toArray();
        // $master_kelas = DB::table('master_kelas')->pluck('id')->toArray();
        // for ($i = 0; $i < 10; $i++) {
        //     DB::table('member_kelas')->insert([
        //         'kd_kelas' => $faker->randomElement($master_kelas),
        //         'nim_mhs' => $faker->randomElement($siswa),
        //         'thn_ajaran' => $faker->year,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }           

        //Create Presensi
        // $memberKelas = DB::table('member_kelas')->pluck('id')->toArray();
        // $mahasiswa = DB::table('mahasiswas')->pluck('id')->toArray();
        // $dosen = DB::table('dosens')->pluck('id')->toArray();
        // $master_kelas = DB::table('master_kelas')->pluck('id')->toArray();
        // for ($i = 0; $i < 10; $i++) {
        //     Presensi::create([
        //         'member_id' => $memberKelas,
        //         'mahasiswa_id' => $mahasiswa,
        //         'dosen_id' => $dosen,
        //         'master_id' => $master_kelas,
        //         'lokasi_gps' => $faker->address
        //     ]);
        // } 
        
        //Create Jadwal
        // $mahasiswa = DB::table('mahasiswas')->pluck('id')->toArray();
        // $dosen = DB::table('dosens')->pluck('id')->toArray();
        // $matkul = DB::table('matkuls')->pluck('id')->toArray();
        // $master_kelas = DB::table('master_kelas')->pluck('id')->toArray();
        // $presensi = DB::table('presensis')->pluck('id')->toArray();
        // for ($i = 0; $i < 10; $i++) {
        //     Jadwal::create([
        //         'dosen_id' => $dosen,
        //         'master_id' => $master_kelas,
        //         'matkul_id' => $matkul,
        //         'jam' => $faker->time($format = 'H:i:s', $max = 'now'),
        //         'tgl_awal' => $faker->date($format = 'Y-m-d', $max = 'now'),
        //         'tgl_akhir' => $faker->date($format = 'Y-m-d', $max = 'now')
        //     ]);
        // } 
        

        //  for ($i = 0; $i < 10; $i++) {
        //      User::create([
        //          'username' => $faker->userName,
        //          'password' => bcrypt('password'),
        //          'role' => $faker->randomElement(['admin', 'dosen']),
        //      ]);
        //  }
 
        //  $users = User::whereIn('role', ['admin', 'dosen'])->get();
 
        //  foreach ($users as $user) {
        //      if ($user->role === 'admin') {
        //          Admin::create([
        //              'name' => $faker->name,
        //              'no_karyawan' => $faker->unique()->numberBetween(100000,999999),
        //              'user_id' => $user->id,
        //          ]);
        //      } else {
        //          Dosen::create([
        //              'name' => $faker->name,
        //              'kd_dosen' => $faker->unique()->numberBetween(100000,999999),
        //              'user_id' => $user->id,
        //          ]);
        //      }
        //  }
    //  }

    // public function run()
    // {
    //     $faker = Faker::create();
    //     for ($i = 0; $i < 10; $i++) {
    //         $role = $faker->randomElement(['admin', 'dosen']);
    //         if ($role == 'admin') {
    //             $admin = Admin::create([
    //                 'no_karyawan' => $faker->unique()->randomNumber(8),
    //                 'name' => $faker->name
    //             ]);
    //             User::create([
    //                 'username' => $admin->no_karyawan,
    //                 'password' => bcrypt($admin->name),
    //                 'role' => $role,
    //                 'user_id' => $admin->id
    //             ]);
    //         } else {
    //             $dosen = Dosen::create([
    //                 'kd_dosen' => $faker->unique()->randomNumber(8),
    //                 'name' => $faker->name
    //             ]);
    //             User::create([
    //                 'username' => $dosen->kd_dosen,
    //                 'password' => bcrypt($dosen->name),
    //                 'role' => $role,
    //                 'user_id' => $dosen->id
    //             ]);
    //     }
    // }
    // }
}
}
