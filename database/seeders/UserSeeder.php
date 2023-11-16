<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class,10)->create();
        // DB::table('users')->insert([
        //     [
        //         'name'      => 'Rahmat Hidayatullah',
        //         'email'     => 'admin@gmail.com',
        //         'password'  => Hash::make('password'),
        //         'role'      => 'admin',
        //     ],
        //     [
        //         'name'      => 'Ayane',
        //         'email'     => 'ayane@gmail.com',
        //         'password'  => Hash::make('password'),
        //         'role'      => 'admin',
        //     ],
        //     [
        //         'name'      => 'Chika Fujiwara',
        //         'email'     => 'chika@gmail.com',
        //         'password'  => Hash::make('password'),
        //         'role'      => 'user',
        //     ],
        //     [
        //         'name'      => 'Kotone',
        //         'email'     => 'kotone@gmail.com',
        //         'password'  => Hash::make('password'),
        //         'role'      => 'user',
        //     ],
        // ]);
    }
}
